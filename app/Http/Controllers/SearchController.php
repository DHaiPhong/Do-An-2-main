<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function getCategoriesWithSub()
    {
        $categories = DB::table('categories')->whereNull('parent_id')->get();

        $categories->map(function ($category) {
            $category->subCategories = $this->getSubCategories($category->id);
            return $category;
        });

        return $categories;
    }

    protected function getSubCategories($category_id)
    {
        $subCategories = DB::table('categories')->where('parent_id', $category_id)->get();

        // recurse for any sub categories
        $subCategories->map(function ($subCategory) {
            $subCategory->subCategories = $this->getSubCategories($subCategory->id);
            return $subCategory;
        });

        return $subCategories;
    }

    public function search(Request $request)
    {
        $search = $request->input('query');
        $product = Product::where('prd_name', 'LIKE', "%{$search}%")


            ->join('prd_img', 'products.prd_id', '=', 'prd_img.prd_id')
            ->groupBy('products.prd_id')
            ->paginate(12);
        $categories = $this->getCategoriesWithSub();

        return view('users.modun-user.product', ['prds' => $product, 'categories' => $categories, 'title' => 'Product']);
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
