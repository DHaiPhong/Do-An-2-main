<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->input('query');
        $product = Product::where('prd_name', 'LIKE', "%{$search}%")


            ->join('prd_img', 'products.prd_id', '=', 'prd_img.prd_id')
            ->groupBy('products.prd_id')

            ->paginate(12);
        $cate = DB::table('categories')
            ->get();
        return view('users.modun-user.product', ['prds' => $product, 'cate' => $cate, 'title' => 'Product']);
    }
    public function suggestions(Request $request)
    {
        $search = $request->input('query');
        $results = Product::where('prd_name', 'LIKE', "%{$search}%")


            ->join('prd_img', 'products.prd_id', '=', 'prd_img.prd_id')
            ->groupBy('products.prd_id')

            ->get();

        return response()->json($results);
    }
}
