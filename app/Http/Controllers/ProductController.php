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
            ->where('product_details.prd_id', $id)

            ->get();

        $prdsize = DB::table('product_details')
            ->join('products', 'product_details.prd_id', '=', 'products.prd_id')
            ->where('product_details.prd_id', $id)
            ->groupBy('product_details.prd_size')
            ->get();

        $prd = DB::table('product_details')
            ->join('products', 'product_details.prd_id', '=', 'products.prd_id')
            ->where('product_details.prd_id', $id)
            ->first();

        $prdimg = DB::table('prd_img')
            ->where('prd_id', $id)
            ->get();

        $otherprd = DB::table('products')

            ->join('prd_img', 'products.prd_id', '=', 'prd_img.prd_id')
            ->groupBy('products.prd_id')
            ->where('products.prd_id', '!=', $id)
            ->inRandomOrder(5)
            ->limit(5)
            ->get();


        return view('users.modun-user.productdetail', [ 'products' => $products, 'prdsize' => $prdsize,'prd' => $prd,'prdimg' => $prdimg,'otherprd'  => $otherprd, 'title' => 'Product']);
    }

    function product()
    {

        $product = DB::table('products')

            ->join('prd_img', 'products.prd_id', '=', 'prd_img.prd_id')
            ->groupBy('products.prd_id')

            ->paginate(12);
        $categories = $this->getCategoriesWithSub();

        return view('users.modun-user.product', ['prds' => $product, 'categories' => $categories, 'title' => 'Product']);
    }

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

    protected function getSubCategoriesIds($id)
    {
        $categoryIds = [$id]; // Add the current category id

        $categories = DB::table('categories')
            ->where('parent_id', $id)
            ->get();

        foreach ($categories as $category) {
            $categoryIds = array_merge($categoryIds, $this->getSubCategoriesIds($category->id));
        }

        return $categoryIds;
    }

    public function prdbyCategory($slug)
    {
        $category = DB::table('categories')->where('slug', $slug)->first();
        // Here, we get the category using the slug, then store its id in the variable $id.
        $id = $category->id;

        $categoryIds = $this->getSubCategoriesIds($id);

        $product = DB::table('products')
            ->join('prd_img', 'products.prd_id', '=', 'prd_img.prd_id')
            ->whereIn('products.category_id', $categoryIds)
            ->groupBy('products.prd_id')
            ->paginate(12);

        $categories = $this->getCategoriesWithSub();

        return view('users.modun-user.product', [
            'prds' => $product,
            'title' => 'Product',
            'categories' => $categories // Add this line
        ]);
    }
}
