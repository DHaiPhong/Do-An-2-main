<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SendCommentRequest;
use App\Models\Comment;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    function prd_detail($id)
    {
        DB::table('products')
            ->where('slug', $id)
            ->increment('views');

        $prdd =  DB::table('products')
            ->where('slug', $id)
            ->first();

        $products = DB::table('product_details')
            ->join('products', 'product_details.prd_id', '=', 'products.prd_id')
            ->where('product_details.prd_id', $prdd->prd_id)
            ->get();

        $prdsize = DB::table('product_details')
            ->join('products', 'product_details.prd_id', '=', 'products.prd_id')
            ->where('product_details.prd_id', $prdd->prd_id)
            ->groupBy('product_details.prd_size')
            ->get();

        $prd = DB::table('product_details')
            ->join('products', 'product_details.prd_id', '=', 'products.prd_id')
            ->where('product_details.prd_id', $prdd->prd_id)
            ->first();

        $prdimg = DB::table('prd_img')
            ->where('prd_id', $prdd->prd_id)
            ->get();

        $otherprd = DB::table('products')

            ->join('prd_img', 'products.prd_id', '=', 'prd_img.prd_id')
            ->groupBy('products.prd_id')
            ->where('products.prd_id', '!=', $prdd->prd_id)
            ->inRandomOrder()
            ->limit(5)
            ->get();

        return view('users.modun-user.productdetail', ['products' => $products, 'prdsize' => $prdsize, 'prd' => $prd, 'prdimg' => $prdimg, 'otherprd'  => $otherprd, 'title' => 'Product']);
    }

    function product()
    {

        $product = DB::table('products')

            ->join('prd_img', 'products.prd_id', '=', 'prd_img.prd_id')
            ->groupBy('products.prd_id')
            ->inRandomOrder()
            ->paginate(12);
        $categories = $this->getCategoriesWithSub();


        return view('users.modun-user.product', ['prds' => $product, 'categories' => $categories, 'title' => 'Sản Phẩm', 'cat' => 'Sản Phẩm']);
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

    public function loadComment(Request $request)
    {
        $product_id = $request->product_id;
        $comment = Comment::where('product_id', $product_id)->with('user')->get();
        $output = '';
        foreach ($comment as $key => $comm) {
            $time = $comm->updated_at->format('H:i:s'); // Grab time (hours, minutes, seconds)
            $date = $comm->updated_at->format('Y-m-d'); // Grab date (year, month, day)
            $output .= '
        <div class="row justify-content-center">
            <div class="col-md-8">
                <ul>
                    <li><a style="font-size: 2rem" href=""><i class="fa fa-user"></i>' . $comm->user->name . '</a></li>
                    <li><a style="font-size: 2rem" href=""><i class="fa fa-clock-o"></i>' . $time . '</a></li>
                    <li><a style="font-size: 2rem" href=""><i class="fa fa-calendar-o"></i>' . $date . '</a></li>
                </ul>
            </div>
            <div class="style-comment">
                <div class="col-md-12">
                    <p style="font-size: 1.8rem">' . $comm->comment . '</p>
                </div>
            </div>
        </div>';
        }
        echo $output;
    }



    // public function sendComment(Request $request)
    // {
    //     $product_id = $request->product_id;
    //     $user_id = $request->user_id;
    //     $comment_content = $request->comment_content;
    //     $comment = new Comment();
    //     $comment->comment = $comment_content;
    //     $comment->user_id = $user_id;
    //     $comment->product_id = $product_id;
    //     $comment->save();
    // }

    public function sendComment(Request $request)
    {
        $product_id = $request->product_id;
        $user_id = $request->user_id;
        $comment_content = $request->comment_content;

        // Kiểm tra xem người dùng có đơn hàng nào hoàn thành hay không
        $order = Order::where('user_id', $user_id)
            ->where('status', 'completed')
            ->first();

        if (!$order) {
            // Nếu không có đơn hàng hoàn thành, trả về lỗi
            return response()->json(['error' => 'Bạn chỉ có thể đánh giá sau khi mua sản phẩm và đơn hàng đã hoàn thành. Bạn chưa có đơn hàng nào được hoàn thành!'], 403);
        }

        // Kiểm tra xem đơn hàng đã mua sản phẩm chưa
        $orderItem = OrderItem::where('order_id', $order->id)
            ->whereHas('productDetail', function ($q) use ($product_id) {
                $q->where('prd_id', $product_id);
            })
            ->first();

        if (!$orderItem) {
            // Nếu không có sản phẩm trong đơn hàng hoàn thành, trả về lỗi
            return response()->json(['error' => 'Bạn chỉ có thể đánh giá sau khi mua sản phẩm này và đơn hàng đã hoàn thành.'], 403);
        }

        // Nếu tất cả điều kiện đều đúng, tiếp tục tạo bình luận
        $comment = new Comment();
        $comment->comment = $comment_content;
        $comment->user_id = $user_id;
        $comment->product_id = $product_id;
        $comment->save();

        return response()->json(['success' => 'Thêm bình luận thành công!']);
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
        $cat = $category->name;

        $categoryIds = $this->getSubCategoriesIds($id);

        $product = DB::table('products')
            ->join('prd_img', 'products.prd_id', '=', 'prd_img.prd_id')
            ->whereIn('products.category_id', $categoryIds)
            ->groupBy('products.prd_id')
            ->orderBy('products.prd_name')
            ->paginate(12);

        $categories = $this->getCategoriesWithSub();

        return view('users.modun-user.product', [
            'prds' => $product,
            'title' => 'Product',
            'categories' => $categories, // Add this line
            'cat' => $cat

        ]);
    }
}
