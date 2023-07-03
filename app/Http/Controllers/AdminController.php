<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use Encore\Admin\Grid\Filter\Where;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;


use PhpParser\Node\Stmt\Function_;

class AdminController extends Controller
{
    //dashboard
    function dashboard()
    {
        $sold = DB::table('orders')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->whereIn('status', ['pending', 'completed', 'processing'])
            ->sum('quantity');

        $revenue = DB::table('orders')

            ->where('status', 'completed')
            ->sum('grand_total');

        $orders = DB::table('orders')

            ->whereIn('status', ['pending', 'completed', 'processing', 'shipping'])
            ->count();

        $temp = DB::table('products')
            ->join('prd_img', 'products.prd_id', '=', 'prd_img.prd_id')
            ->select('products.prd_id', 'prd_img.prd_image')
            ->groupBy('products.prd_id');


        $out_of_stocks = DB::table('products')
            ->join('product_details', 'products.prd_id', '=', 'product_details.prd_id')
            ->join('prd_img', 'products.prd_id', '=', 'prd_img.prd_id')
            ->select('product_details.prd_amount', 'products.prd_name', 'prd_img.prd_image', 'product_details.prd_size', 'product_details.prd_detail_id')
            ->where('product_details.prd_amount', '<', 3)
            ->groupBy('products.prd_id')
            ->orderBy('prd_amount', 'desc')
            ->get();

        $sells = DB::table('products')
            ->joinSub($temp, 'temp', function (JoinClause $join) {
                $join->on('products.prd_id', '=', 'temp.prd_id');
            })
            ->join('product_details', 'products.prd_id', '=', 'product_details.prd_id')
            ->select('product_details.sold', 'temp.prd_image', 'products.prd_name', DB::raw('SUM(product_details.sold) as t_sold'), 'product_details.prd_detail_id')

            ->where('product_details.sold', '!=', 0)
            ->groupBy('products.prd_id')
            ->orderBy('sold', 'desc')
            ->paginate(5);

        return view('Admin/modun/dashboard', ['sold' => $sold, 'revenue' => $revenue, 'out_of_stocks' => $out_of_stocks, 'orders' => $orders, 'sells' => $sells]);
    }


    function chart(Request $request)
    {
        $entries = Order::select([
            DB::raw('MONTH(created_at) as month'),
            //            DB::raw('YEAR(created_at) as year'),
            DB::raw('SUM(grand_total) as grand_total'),

        ])
            ->whereYear('created_at', 2023)
            ->where('status', 'completed')
            ->groupBy([
                'month'
            ])
            ->orderBy('month')
            ->get();
        $labels = [
            1 => 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
        ];
        //        $dataset = [];
        $grand_total = [];
        foreach ($entries as $entry) {
            //            if ($entry->status == 'Gửi Thành Công') {
            $grand_total[$entry->month] = $entry->grand_total;
            //            }
        }
        foreach ($labels as $month => $name) {

            if (!array_key_exists($month, $grand_total)) {
                $grand_total[$month] = 0;
            }
        }
        ksort($grand_total);

        return [
            'labels' => array_values($labels),
            'datasets' => [
                [
                    'label' => 'Revenue(vnd)',
                    'borderWidth' => 1,
                    'data' => array_values($grand_total),


                ],
            ]
        ];
    }

    //---End Dashboard

    //---cac trang---
    function account()
    {
        $users = DB::table('users')->get();
        return view('Admin.modun.account', ['user1' => $users]);
    }

    function product()
    {
        $temp = DB::table('products')
            ->join('prd_img', 'products.prd_id', '=', 'prd_img.prd_id')
            ->select('products.prd_id', 'prd_img.prd_image')
            ->groupBy('products.prd_id');

        $total = DB::table('products')
            ->joinSub($temp, 'temp', function (JoinClause $join) {
                $join->on('products.prd_id', '=', 'temp.prd_id');
            })
            ->join('product_details', 'products.prd_id', '=', 'product_details.prd_id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->count();
        $products = DB::table('products')
            ->joinSub($temp, 'temp', function (JoinClause $join) {
                $join->on('products.prd_id', '=', 'temp.prd_id');
            })
            ->join('product_details', 'products.prd_id', '=', 'product_details.prd_id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select(
                'products.*',
                'categories.name as category',
                'temp.prd_image',
                'product_details.prd_detail_id',
                DB::raw("GROUP_CONCAT(CONCAT(product_details.prd_size, ' (Số lượng: ', product_details.prd_amount, ', Đã bán: ', product_details.sold, ', <a href=\"http://127.0.0.1:8000/admin/product/modify/',product_details.prd_detail_id,'\" style=\"color:#007bff\">Chi Tiết</a>)') SEPARATOR '<br/>' ) AS prd_details")
            )
            ->groupBy('products.prd_id')
            ->orderBy('product_details.prd_id')
            ->offset(0) // update this as needed for the current page
            ->limit(8)
            ->get();


        $paginator = new LengthAwarePaginator($products, $total, 8);

        return view('Admin.modun.product', ['products' => $products, 'paginator' => $paginator]);
    }

    function productorderby($id)
    {
        if ($id == 'amount') {
            $products = DB::table('products')
                ->join('product_details', 'products.prd_id', '=', 'product_details.prd_id')
                ->join('categories', 'products.category_id', '=', 'categories.id')->orderBy('product_details.prd_amount', 'desc')
                ->paginate(8);
        } elseif ($id == 'id') {
            $products = DB::table('products')
                ->join('product_details', 'products.prd_id', '=', 'product_details.prd_id')
                ->join('categories', 'products.category_id', '=', 'categories.id')->orderBy('product_details.prd_detail_id', 'asc')
                ->paginate(8);
        } elseif ($id == 0) {
            $products = DB::table('products')
                ->join('product_details', 'products.prd_id', '=', 'product_details.prd_id')
                ->join('categories', 'products.category_id', '=', 'categories.id')->where('product_details.prd_amount', 0)
                ->paginate(8);
        } else {
            $products = DB::table('products')
                ->join('product_details', 'products.prd_id', '=', 'product_details.prd_id')
                ->join('categories', 'products.category_id', '=', 'categories.id')->orderBy('product_details.sold', 'desc')
                ->paginate(8);
        }
        return view('Admin.modun.product', ['products' => $products]);
    }

    //---sua account---
    function modify($id)
    {
        $user = DB::table('users')->where('id', $id)->first();
        return view('Admin.modun.detail', compact('user'));
    }

    function delete(Request $request, $id)
    {
        $data = [
            'status' => 1
        ];
        DB::table('users')->where('id', $request->id)
            ->update($data);
        return redirect()->route('admin.account');
    }

    function edit(Request $request, $id)
    {
        $data = [

            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'address' => $request->address,
            'phone' => $request->phone,
            'level' => $request->level
        ];
        DB::table('users')->where('id', $request->id)
            ->update($data);
        return redirect()->route('admin.account');
    }
    //---
    //---Sua product---
    function prd_modify($id)
    {
        $product = DB::table('products')

            ->join('product_details', 'products.prd_id', '=', 'product_details.prd_id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->where('product_details.prd_detail_id', $id)
            ->groupBy('products.prd_id')
            ->first();

        $cate = DB::table('categories')
            ->get();
        $images = DB::table('products')
            ->join('prd_img', 'products.prd_id', '=', 'prd_img.prd_id')
            ->join('product_details', 'products.prd_id', '=', 'product_details.prd_id')
            ->where('product_details.prd_detail_id', $id)

            ->get();

        return view('Admin.modun.prd_detail', compact(['product', 'images', 'cate']));
    }
    function removeImage($image)
    {
        DB::table('prd_img')
            ->where('id', $image)
            ->delete();


        return back();
    }

    function prd_edit(Request $request, $id)
    {

        if ($request->images != null) {

            $this->validate($request, [
                'images' => 'required',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
            $input = $request->all();
            $images = array();
            if ($files = $request->file('images')) {
                foreach ($files as $file) {
                    $name = $file->getClientOriginalName();
                    $file->move('anh', $name);
                    $images[] = $name;
                }
            }


            /*Insert your data*/
            foreach ($images as $image) {
                DB::table('prd_img')
                    ->insert([
                        'prd_image' =>  $image,
                        'prd_id' => $id,

                    ]);
            }
        }

        $data = [

            'products.prd_name' => $request->prd_name,
            'products.category_id' => $request->category_id,
            'products.price' => $request->prd_price,
            'product_details.prd_amount' => $request->prd_amount,
            'products.prd_details' => $request->prd_details,
            'products.prd_sale' => $request->prd_sale

        ];



        DB::table('products')
            ->join('product_details', 'products.prd_id', '=', 'product_details.prd_id')
            ->where('prd_detail_id', $request->prd_detail_id)
            ->update($data);


        return back();
    }
    function delete_prd($id)
    {
        // start the transaction
        DB::beginTransaction();

        try {
            // delete product details
            DB::table('product_details')->where('prd_id', $id)->delete();

            // delete product images
            DB::table('prd_img')->where('prd_id', $id)->delete();

            // delete the product
            DB::table('products')->where('prd_id', $id)->delete();

            // commit the transaction
            DB::commit();

            return redirect()->route('admin.product')->with('message', 'Product has been deleted successfully.');
        } catch (\Exception $e) {
            // something went wrong
            // rollback the transaction
            DB::rollback();

            return redirect()->route('admin.product')->with('error', 'Failed to delete the product.');
        }
    }
    function delete_size($id)
    {


        $prd_id = DB::table('product_details')
            ->where('prd_detail_id', $id)
            ->value('prd_id');

        DB::table('product_details')
            ->where('prd_detail_id', $id)
            ->delete();
        $check = DB::table('products')
            ->where('prd_id', $prd_id)
            ->get();

        if ($check == null) {
            DB::beginTransaction();

            try {
                // delete product details
                DB::table('product_details')->where('prd_id', $id)->delete();

                // delete product images
                DB::table('prd_img')->where('prd_id', $id)->delete();

                // delete the product
                DB::table('products')->where('prd_id', $id)->delete();

                // commit the transaction
                DB::commit();

                return redirect()->route('admin.product')->with('message', 'Product has been deleted successfully.');
            } catch (\Exception $e) {
                // something went wrong
                // rollback the transaction
                DB::rollback();

                return redirect()->route('admin.product')->with('error', 'Failed to delete the product.');
            }
        }

        return redirect()->route('admin.product')->with('Notification', 'Product size has been removed');
    }
    function delete_prd_img($id)
    {
        DB::table('product_details')
            ->where('prd_detail_id', $id)
            ->delete();
        return redirect()->back();;
    }


    //---------------add prd---------------

    function prd_add(Request $request)
    {
        if ($request->newprd == null) {
            $check = DB::table('products')
                ->join('product_details', 'products.prd_id', '=', 'product_details.prd_id')
                ->where('product_details.prd_size', $request->prd_size)
                ->where('products.prd_id', $request->prd_id)
                ->get();

            if ($check->isEmpty()) {
            } else {
                return back()->with('loi', 'Size này của sản phẩm đã có');
            }
        } else {

            $this->validate($request, [
                'images' => 'required',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
            $prd = [

                'prd_name' => $request->newprd,
                'category_id' => $request->category_id,
                'slug' => $request->slug,
                'price' => $request->prd_price,
                'prd_sale' => $request->prd_sale,

            ];
            DB::table('products')
                ->insert($prd);

            $temp = DB::table('products')
                ->max('prd_id');

            $input = $request->all();
            $images = array();
            if ($files = $request->file('images')) {
                foreach ($files as $file) {
                    $name = $file->getClientOriginalName();
                    $file->move('anh', $name);
                    $images[] = $name;
                }
            }
            foreach ($images as $image) {
                DB::table('prd_img')
                    ->insert([
                        'prd_image' =>  $image,
                        'prd_id' => $temp,

                    ]);
            }
        }

        if ($request->newprd == null) {
            $prddetail = [
                'prd_id' => $request->prd_id,
                'prd_amount' => $request->prd_amount,
                'prd_size' => $request->prd_size,

            ];
        } else {
            $prddetail = [
                'prd_id' => $temp,
                'prd_amount' => $request->prd_amount,
                'prd_size' => $request->prd_size
            ];
        }
        DB::table('product_details')
            ->insert($prddetail);
        return redirect()->route('admin.product')->with('success', 'Thêm sản phẩm thành công');
    }

    function addprdform()
    {
        $products = DB::table('products')
            ->get();
        $categories = DB::table('categories')
            ->get();

        return view('Admin/modun/addprd', compact(['products', 'categories']));
    }

    //--------------End add prd
    function order()
    {
        $orders = DB::table('orders')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->groupBy('orders.id')
            ->orderByDesc('orders.id')
            ->paginate(6);
        return view('Admin.modun.order', compact('orders'));
    }

    function orderdetail($id)
    {
        $orders = DB::table('orders')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')

            ->join('product_details', 'order_items.product_id', '=', 'product_details.prd_detail_id')
            ->join('products', 'products.prd_id', '=', 'product_details.prd_id')
            ->join('prd_img', 'products.prd_id', '=', 'prd_img.prd_id')
            ->groupBy('products.prd_id')
            ->where('orders.id', $id)

            ->get();

        return view('Admin.modun.orderdetail', compact('orders'));
    }

    function updateStatus($id, $value)
    {
        $order = DB::table('orders')
            ->where(
                'id',
                $id
            )
            ->first();

        if (!$order) {
            return redirect()->route('admin.order')->with('error', 'Không tìm thấy đơn hàng!');
        }

        if ($order->status == 'completed') {
            return redirect()->route('admin.order')->with('error', 'Không thể thay đổi trạng thái của đơn hàng đã hoàn thành!');
        }

        if ($order->status == 'cancel') {
            return redirect()->route('admin.order')->with('error', 'Không thể thay đổi trạng thái của đơn hàng đã hủy!');
        }

        if ($order->status == 'processing' && $value == 'cancel') {
            return redirect()->route('admin.order')->with('error', 'Không thể hủy đơn hàng đang xử lý!');
        }

        if ($value == 'cancel') {
            DB::table('orders')
                ->where('id', $id)
                ->update(['status' => 'cancel']);
        } else if ($value == "processing") {
            DB::table('orders')
                ->where('id', $id)
                ->update(['status' => 'processing']);
        } else if ($value == "shipping") {
            DB::table('orders')
                ->where('id', $id)
                ->update(['status' => 'shipping']);
        } else if ($value == "completed") {
            DB::table('orders')
                ->where('id', $id)
                ->update(['status' => 'completed']);
        }

        return redirect()->route('admin.order')->with('success', 'Cập nhật trạng thái thành công');
    }


    function orderorderby($id)
    {
        if ($id == 'pending') {
            $orders = DB::table('orders')
                ->join('order_items', 'orders.id', '=', 'order_items.order_id')
                ->groupBy('orders.id')
                ->where('orders.status', $id)
                ->orderByDesc('orders.id')
                ->paginate(5);
        } else if ($id == 'completed') {
            $orders = DB::table('orders')
                ->join('order_items', 'orders.id', '=', 'order_items.order_id')
                ->groupBy('orders.id')
                ->where('orders.status', $id)
                ->orderByDesc('orders.id')
                ->paginate(6);
        } else if ($id  == 'processing') {
            $orders = DB::table('orders')
                ->join('order_items', 'orders.id', '=', 'order_items.order_id')
                ->groupBy('orders.id')
                ->where('orders.status', $id)
                ->orderByDesc('orders.id')
                ->paginate(6);
        } else if ($id == 'cancel') {
            $orders = DB::table('orders')
                ->join('order_items', 'orders.id', '=', 'order_items.order_id')
                ->groupBy('orders.id')
                ->where('orders.status', $id)
                ->orderByDesc('orders.id')
                ->paginate(6);
        } else {
            $orders = DB::table('orders')
                ->join('order_items', 'orders.id', '=', 'order_items.order_id')
                ->groupBy('orders.id')
                ->orderByDesc('orders.id')
                ->paginate(6);
        }
        return view('Admin.modun.order', compact('orders'));
    }


    //------------------Add img------------------
    function storeimg(Request $request)
    {
        $this->validate($request, [
            'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $input = $request->all();
        $images = array();
        if ($files = $request->file('images')) {
            foreach ($files as $file) {
                $name = $file->getClientOriginalName();

                $file->move('anh', $name);
                $images[] = $name;
            }
        }
        dd($files);

        /*Insert your data*/
        foreach ($images as $image) {
            DB::table('prd_img')
                ->insert([
                    'img' =>  $image,
                    'prd_id' => 1,

                ]);
        }
        return back();
    }
}
