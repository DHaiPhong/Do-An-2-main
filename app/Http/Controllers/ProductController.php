<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function prd_detail($id)
    {
        $products = DB::table('product_details')

        ->join('products', 'product_details.prd_id', '=', 'products.prd_id')
        ->where('product_details.prd_id',$id)
        
        ->get();

        $prdsize = DB::table('product_details')
        ->join('products', 'product_details.prd_id', '=', 'products.prd_id')
        ->where('product_details.prd_id',$id)
        ->groupBy('product_details.prd_size')
        ->get();
        
        $prd = DB::table('product_details')
        ->join('products', 'product_details.prd_id', '=', 'products.prd_id')
        ->where('product_details.prd_id',$id)
        ->first();

        $prdimg = DB::table('prd_img')
        ->where('prd_id',$id)
        ->get();

        $otherprd = DB::table('products')
        
        ->join('prd_img','products.prd_id', '=','prd_img.prd_id')
        ->groupBy('products.prd_id')
        ->where('products.prd_id', '!=', $id)
        ->inRandomOrder(5)
        ->limit(5)
        ->get();
        

        return view ('users.modun-user.productdetail',compact(['products','prdsize','prd','prdimg','otherprd','title' => 'Product']));

    }

    function product()
    {

        $product = DB::table('products')

        ->join('prd_img','products.prd_id', '=', 'prd_img.prd_id')
        ->groupBy('products.prd_id')
            
            ->paginate(12);
        $cate = DB::table('category')
        ->get();
            
        return view('users.modun-user.product',['prds'=>$product,'cate'=>$cate,'title' => 'Product']);
    }

    function prdbybrand($id){
        $cate = DB::table('category')
        ->get();
        $product = DB::table('products')
            
            ->join('prd_img','products.prd_id', '=', 'prd_img.prd_id')
            ->groupBy('products.prd_id')
            ->where('products.cat_id',$id)
            ->paginate(12);
            
        return view('users.modun-user.product',['prds'=>$product,'cate'=>$cate,'title' => 'Product']);

    }
}
