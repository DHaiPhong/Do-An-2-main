<?php

namespace App\Http\Controllers;

use App\Models\CategoryBlog;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Product;

class userController extends Controller
{
    function updateacc(Request $data)
    {
      
            $dt = [
                'name' => $data['name'],
                'email' => $data['email'],

                'address' => $data['address'],
                'phone' => $data['phone'],
            ];
        
        $user = DB::table('users')
            ->where('id', Auth::user()->id)
            ->update($dt);
        return back();
    }
    function resetpassword(Request $request){
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);


        #Match The Old Password
        if(!Hash::check($request->old_password, auth()->user()->password)){
            return back()->with("error", "Sai mật khẩu!");
        }elseif($request->old_password == $request->password){
            return back()->with("error", "Mật khẩu mới không được giống mật khẩu cũ!");
        }else{
            User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->password)
        ]);
        }


        #Update the new Password
        

        return back()->with("status", "Thay đổi mật khẩu thành công!");
    
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

        $temp = DB::table('products')
            ->join('prd_img', 'products.prd_id', '=', 'prd_img.prd_id')
            ->select('products.prd_id', 'prd_img.prd_image')
            ->groupBy('products.prd_id');
        $orders = DB::table('orders')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')

            ->join('product_details', 'order_items.product_id', '=', 'product_details.prd_detail_id')
            ->join('products', 'products.prd_id', '=', 'product_details.prd_id')
            ->joinSub($temp, 'temp', function (JoinClause $join) {
                $join->on('products.prd_id', '=', 'temp.prd_id');
            })
            
            ->where('orders.user_id', Auth::user()->id)
            ->where('orders.id', $id)
            ->get();
            $odnb = DB::table('orders')
            ->where('orders.user_id', Auth::user()->id)
            ->where('orders.id', $id)
            ->first();
            $coupon = DB::table('orders') 
            ->join('coupons','orders.coupon','=','coupons.id')
            ->where('orders.user_id', Auth::user()->id)
            ->where('orders.id', $id)
            ->first();
        return view('users.modun-user.orderdetail', ['orders' => $orders,'odnb' => $odnb,'coupon' => $coupon, 'title' => 'Chi Tiết Đơn Hàng']);
    }

    function ordercancel($id)
    {
        $order = DB::table('orders')
            ->where('id', $id)
            ->first();
        


        if (!$order) {
            return back()->with('error', 'Không tìm thấy đơn hàng!');
        }

        if ($order->status != 'pending') {
            return back()->with('error', 'Chỉ có thể hủy đơn hàng khi đang duyệt!');
        }
        $order = DB::table('orders')
            ->where('id', $id)
            ->update(['status' => 'cancel','updated_at'=>now(),'updated_by'=>Auth::user()->id]);
        
        $order_items = DB::table('order_items')->where('order_id', $id)->get();
            foreach ($order_items as $item) {
                $product = DB::table('product_details')->where('prd_detail_id', $item->product_id)->first();
                $amount = $product->prd_amount;
                DB::table('product_details')
                    ->where('prd_detail_id', $item->product_id)
                    ->update(['prd_amount' =>  $amount + $item->quantity]);
            }

        return back()->with('success', 'Hủy đơn hàng thành công');
    }


    function index()
    {
        $sells = DB::table('products')
            ->join('prd_img', 'products.prd_id', '=', 'prd_img.prd_id')
            ->join('product_details', 'products.prd_id', '=', 'product_details.prd_id')
            ->groupBy('products.prd_id')
            ->orderBy('sold', 'desc')
            ->paginate(10);

        $views = DB::table('products')
            ->join('prd_img', 'products.prd_id', '=', 'prd_img.prd_id')
            ->join('product_details', 'products.prd_id', '=', 'product_details.prd_id')
            ->groupBy('products.prd_id')
            ->orderBy('views', 'desc')
            ->paginate(10);
        $rate = DB::table('products')
            ->join('prd_img', 'products.prd_id', '=', 'prd_img.prd_id')
            ->join('rating', 'products.prd_id', '=', 'rating.product_id')
            ->select('products.*','prd_img.*', DB::raw('AVG(rating.rating) as average_rating'))
            ->groupBy('products.prd_id')
            ->orderBy('average_rating', 'desc')
            ->take(3)
            ->get();

        

            
        return view('users.modun-user.index', ['sells' => $sells, 'views' => $views, 'rates' => $rate ,'title' => 'Trang Chủ']);
    }

    public function about()
    {
        return view('users.modun-user.about', ['title' => 'Thông Tin']);
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
