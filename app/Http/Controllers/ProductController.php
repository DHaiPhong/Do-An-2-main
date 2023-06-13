<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function prd_detail($id){
        $products = DB::table('product_details')
        ->join('products', 'product_details.prd_id', '=', 'products.prd_id')
        ->where('product_details.prd_id',$id)
        ->groupBy('product_details.prd_color') 
        ->get();

        $prdsize = DB::table('product_details')
        ->join('products', 'product_details.prd_id', '=', 'products.prd_id')
        ->where('product_details.prd_id',$id)
        ->groupBy('product_details.prd_size')
        ->get();
        
        

        $prdimg = DB::table('product_details')
        ->join('products', 'product_details.prd_id', '=', 'products.prd_id')
        ->where('product_details.prd_id',$id)
        ->groupBy('product_details.prd_image')
        ->get();

        return view ('users.modun-user.productdetail',compact('products','prdsize'));
    }

    function product(){

        $product = DB::table('products')
            ->join('product_details', 'products.prd_id', '=', 'product_details.prd_id')
            ->groupByRaw('products.prd_id')
            ->paginate(9);
            
        return view('users.modun-user.product',['prds'=>$product]);
    }

    function prdbybrand($id){

        $product = DB::table('products')
            ->join('product_details', 'products.prd_id', '=', 'product_details.prd_id')
            ->groupByRaw('products.prd_id')
            ->where('products.cat_id',$id)
            ->paginate(9);
            
        return view('users.modun-user.product',['prds'=>$product]);
    }
    
    
}
