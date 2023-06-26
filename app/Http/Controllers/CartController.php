<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Cart;
use Illuminate\Notifications\Notifiable;

class CartController extends Controller
{
    function addcart(Request $request)
    {
       
    
        $product = DB::table('products')
            ->join('product_details', 'products.prd_id', '=', 'product_details.prd_id')
            ->join('prd_img','products.prd_id','=','prd_img.prd_id')
            ->where('product_details.prd_id', $request->prd_id)
            ->where('product_details.prd_size', $request->prd_size)
            ->where('product_details.prd_color', $request->prd_color)
            ->first();
        
        if ($product->prd_amount == 0) {
        }else{
        $data = Cart::content()
        ->where('id',$product->prd_detail_id)
        ->first();
        
        if($data != null){
            if ($product->prd_amount > $data->qty){
                Cart::add($product->prd_detail_id, $product->prd_name, '1', $request->price, '0', ['size' => $product->prd_size, 'color' => $product->prd_color, 'img' => $product->prd_image]);

            }else{

            }
        }else{
        Cart::add($product->prd_detail_id, $product->prd_name, '1', $request->price, '0', ['size' => $product->prd_size, 'color' => $product->prd_color, 'img' => $product->prd_image]);   
        }
        
}
        return redirect()->route('users.cartshop');
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

    function pluscart($id)
    {

        $data = Cart::get($id);
        $product = DB::table('product_details')->where('prd_detail_id', $data->id)->first();
        if ($product->prd_amount > $data->qty) {
            Cart::update($id, ['qty' => $data->qty + 1]);

        }
        return back();
    }
    function minuscart($id)
    {
        $data = Cart::get($id);
        Cart::update($id, ['qty' => $data->qty - 1]);
        return back();
    }

    function pay()
    {
        if(Auth::user()==null ){
            return redirect()->route('login');
        }

        return view('users.modun-user.payment');
    }
    function cartsuccess()
    {
        if(Auth::user()==null ){
            return redirect()->route('login');
        }

        foreach(Cart::Content() as $item) {
        $product = DB::table('product_details')
        ->where('prd_detail_id',$item->id)
        ->sum('prd_amount');
        
        $sold = DB::table('product_details')
        ->where('prd_detail_id',$item->id)
        ->sum('sold');

        DB::table('product_details')
        ->where('prd_detail_id',$item->id)
        ->update(['prd_amount' =>  $product - $item->qty])
        
        ;
        DB::table('product_details')
        ->where('prd_detail_id', $item->id)
        ->update(['sold' => $sold + $item->qty]);
        
        }
        
        Cart::destroy();
        
return view('users.modun-user.Cartsuccess');
    }
}


