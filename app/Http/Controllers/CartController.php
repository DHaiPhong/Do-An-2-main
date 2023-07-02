<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddCartRequest;
use App\Models\Product;
use App\Models\ProductDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Notifications\Notifiable;

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
        } else {
            $data = Cart::content()
                ->where('id', $product->prd_detail_id)
                ->first();

            if ($data != null) {
                if ($product->prd_amount > $data->qty) {
                    Cart::add($product->prd_detail_id, $product->prd_name, '1', $request->price, '0', ['size' => $product->prd_size, 'img' => $product->prd_image]);
                } else {
                }
            } else {
                Cart::add($product->prd_detail_id, $product->prd_name, '1', $request->price, '0', ['size' => $product->prd_size,  'img' => $product->prd_image]);
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


    function pay()
    {
        if (Auth::user() == null) {
            return redirect()->route('login');
        }
        $data = Cart::count();
        if ( $data == 0  ){
            return redirect()->route('home1');
        }

        return view('users.modun-user.payment', ['title' => 'Thanh Toán']);
    }

    public function update(Request $request)
    {
        Cart::update($request->rowId, $request->qty);
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
            DB::table('product_details')
                ->where('prd_detail_id', $item->id)
                ->update(['sold' => $sold + $item->qty]);
        }

        Cart::destroy();

        return view('users.modun-user.Cartsuccess', ['title' => 'Thành Công']);
    }
}
