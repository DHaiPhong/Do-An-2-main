<?php

namespace App\Http\Controllers;

use App\Models\CategoryBlog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Product;

class userController extends Controller
{
    function updateacc(Request $data)
    {
        if ($data['password'] == null) {
            $dt = [
                'name' => $data['name'],
                'email' => $data['email'],

                'address' => $data['address'],
                'phone' => $data['phone'],
            ];
        } else {
            $dt = [
                'name' => $data['name'],
                'email' => $data['email'],

                'address' => $data['address'],
                'phone' => $data['phone'],

                'password' => Hash::make($data['password']),

            ];
        }
        $user = DB::table('users')
            ->where('id', Auth::user()->id)
            ->update($dt);
        return back();
    }
    function order()
    {
        $orders = DB::table('orders')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->where('orders.user_id', Auth::user()->id)
            ->groupBy('orders.id')
            ->paginate(5);

        return view('users.modun-user.order', ['orders' => $orders, 'title' => 'Account']);
    }

    function orderdetail($id)
    {
        $orders = DB::table('orders')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->join('product_details', 'order_items.product_id', '=', 'product_details.prd_detail_id')
            ->join('products', 'products.prd_id', '=', 'product_details.prd_id')
            ->where('orders.user_id', Auth::user()->id)
            ->where('orders.id', $id)
            ->get();

        return view('users.modun-user.orderdetail', ['orders' => $orders]);
    }

    function ordercancel($id)
    {

        $order = DB::table('orders')
            ->where('id', $id)
            ->first();


        if ($order->status == 'pending') {
            $order = DB::table('orders')
                ->where('id', $id)
                ->update(['status' => 'cancel']);
        }
    return back();
}
   
   function index(){
    $sells = DB::table('products')
    ->join('prd_img','products.prd_id', '=', 'prd_img.prd_id')

            ->join('product_details', 'products.prd_id', '=', 'product_details.prd_id')
            ->groupBy('products.prd_id')

            ->orderBy('sold', 'desc')

            ->paginate(5);

        $blog_categories = CategoryBlog::all();

        return view('users.modun-user.index', ['sells' => $sells, 'title' => 'Home'], compact('blog_categories'));
    }

    function searchproduct(Request $request)
    {
        if ($request->search) {
            $searchproducts = Product::where('prd_name', 'LIKE', '%' . $request->search . '%')
                ->join('product_details', 'products.prd_id', '=', 'product_details.prd_id')
                ->groupByRaw('products.prd_id')
                ->paginate(9);

            return view('users.modun-user.search', ['title' => 'Search Product'], compact('searchproducts'));
        } else {
            return redirect()->back()->with('message', 'Empty Search');
        }
    }
}
