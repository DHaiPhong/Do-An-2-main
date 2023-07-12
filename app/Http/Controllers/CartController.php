<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddCartRequest;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ProductDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    function addcart(AddCartRequest $request)
    {

        $product = DB::table('products')
            ->join('product_details', 'products.prd_id', '=', 'product_details.prd_id')
            ->join('prd_img', 'products.prd_id', '=', 'prd_img.prd_id')
            ->where('product_details.prd_id', $request->prd_id)
            ->where('product_details.prd_size', $request->prd_size)
            ->first();


        if ($product->prd_amount == 0) {
            return redirect()->route('users.cartshop')->with(['fail' => 'Lỗi sản phẩm đã hết hàng!']);
        } else {
            $data = Cart::content()
                ->where('id', $product->prd_detail_id)
                ->first();


            if ($data != null) {
                $totalqty = $request->quantity + $data->qty;

                if ($totalqty <= $product->prd_amount) {

                    Cart::add($product->prd_detail_id, $product->prd_name, $request->quantity, $request->price, '0', ['size' => $product->prd_size, 'img' => $product->prd_image]);
                } else {
                    $data->qty = $product->prd_amount;
                }
            } else {
                Cart::add($product->prd_detail_id, $product->prd_name, $request->quantity, $request->price, '0', ['size' => $product->prd_size,  'img' => $product->prd_image]);
            }
        }
        return redirect()->route('users.cartshop')->with(['success' => 'Thêm sản phẩm thành công!']);
    }

    function deletecart($id)
    {
        if ($id == 'all') {
            Cart::destroy();
        } else {
            Cart::remove($id);
        }
        return back();
    }
    function cartshop()
    {


        return view('users/modun-user/cartshop', ['title' => 'Giỏ Hàng  ']);
    }


    function pay(Request $request)
    {
        if (Auth::user() == null) {
            return redirect()->route('login');
        }
        $data = Cart::count();
        if ($data == 0) {
            return redirect()->route('home1');
        }



        return view('users.modun-user.payment', ['title' => 'Thanh Toán']);
    }

    public function update(Request $request)
    {

        $data = Cart::get($request->rowId);
        $prd = DB::table('product_details')
            ->where('prd_detail_id', $data->id)
            ->first();
        if ($prd->prd_amount > $request->qty) {
            Cart::update($request->rowId, $request->qty);
        } else {
            Cart::update($request->rowId, $prd->prd_amount);
        }
    }
    public function deleteCoupon()
    {
        Session::forget(['id', 'amount', 'code', 'expires_at', 'type']);
        return redirect()->route('users.cartshop');
    }

    public function applyCoupon(Request $request)
    {
        $messages = [
            'code.required' => 'Mã không được để trống',
        ];

        $this->validate($request, [
            'code' => 'required'
        ], $messages);

        $coupon = Coupon::where('code', $request->code)->first();
        $expiresAt = Carbon::parse($coupon->expires_at);
        if ($coupon && $expiresAt->isFuture()) {
            $message = 'Áp Dụng Mã Giảm Giá Thành Công!';
            Session::put('id', $coupon->id);
            Session::put('amount', $coupon->amount);
            Session::put('expires_at', $coupon->expires_at);
            Session::put('type', $coupon->type);
            Session::put('code', $coupon->code);
        } else {
            Session::forget(['id', 'amount', 'code', 'expires_at', 'type']);
            $message = 'Mã giảm giá sai hoặc đã hết hạn';
        }



        return redirect()->route('users.cartshop')->with(['message' => $message]);
        // if (!$coupon || $coupon->expires_at->lt(now())) {
        //     return response()->json(['error' => 'Sai mã giảm giá. Hoặc mã đã hết hạn']);
        // }

        // $cart = Cart::content();
        // $total = Cart::total();

        // // Tính tổng giảm giá
        // if ($coupon->type == 'fixed') {
        //     $discount = $total - $coupon->amount;
        // } else if ($coupon->type == 'percent') {
        //     $discount = $total - ($total * ($coupon->amount / 100));
        // }

        // // dd($discount);

        // // Thêm vào phiên
        // session()->put('coupon', [
        //     'name' => $coupon->code,
        //     'discount' => $discount
        // ]);

        // return response()->json(['success' => 'Áp dụng mã giảm giá thành công!', 'discount' => $discount]);
    }



    function cartsuccess()
    {
        if (Auth::user() == null) {
            return redirect()->route('login');
        }

        foreach (Cart::Content() as $item) {
            $product = DB::table('product_details')
                ->where('prd_detail_id', $item->id)
                ->sum('prd_amount');

            $sold = DB::table('product_details')
                ->where('prd_detail_id', $item->id)
                ->sum('sold');

            DB::table('product_details')
                ->where('prd_detail_id', $item->id)
                ->update(['prd_amount' =>  $product - $item->qty]);
            // DB::table('product_details')
            //     ->where('prd_detail_id', $item->id)
            //     ->update(['sold' => $sold + $item->qty]);
        }

        Cart::destroy();

        return view('users.modun-user.Cartsuccess', ['title' => 'Thành Công']);
    }
}
