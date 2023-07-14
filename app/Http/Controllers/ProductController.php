<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SendCommentRequest;
use App\Models\Comment;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Ui\Presets\React;

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


        $rating = Rating::where('product_id', $prdd->prd_id)->avg('rating');
        $rating_count = Rating::where('product_id', $prdd->prd_id)->count();
        $rating = round($rating);

        return view('users.modun-user.productdetail', ['products' => $products, 'prdsize' => $prdsize, 'prd' => $prd, 'prdimg' => $prdimg, 'rating' => $rating, 'rating_count' => $rating_count, 'otherprd'  => $otherprd, 'title' => 'Product']);
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

    public function insertRating(Request $request)
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Bạn cần đăng nhập để có thể đánh giá'], 403);
        }

        $user_id = auth()->user()->id;
        $product_id = $request->product_id;
        $order = Order::where('user_id', $user_id)
            ->where('status', 'completed')
            ->first();



        $already_rated = Rating::where('product_id', $product_id)
            ->where('user_id', $user_id)
            ->exists();

        if ($already_rated) {
            // If the user has already rated, return an error
            return response()->json(['error' => 'Bạn đã đánh giá sản phẩm này rồi và không thể đánh giá thêm nữa.'], 403);
        }


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


        $data = $request->all();
        $rating = new Rating();
        $rating->product_id = $data['product_id'];
        $rating->rating = $data['index'];
        $rating->user_id = $user_id;
        $rating->save();
        echo 'done';
    }

    public function loadComment(Request $request)
    {
        $product_id = $request->product_id;
        $comments = Comment::where('product_id', $product_id)->whereNull('parent_id')->with('user')->orderBy('created_at', 'desc')->get();
        $comment_replies = Comment::where('product_id', $product_id)->whereNotNull('parent_id')->with('user')->orderBy('created_at', 'desc')->get();
        $output = '';

        foreach ($comments as $comment) {
            $output .= $this->formatComment($comment);

            foreach ($comment_replies as $reply) {
                if ($reply->parent_id == $comment->id) {
                    $output .= $this->formatComment($reply, true);
                }
            }
        }

        return response($output, 200);
    }


    private function getCommentReplies($commentId)
    {
        $replies = Comment::where('parent_id', $commentId)->with('user')->orderBy('created_at', 'desc')->get();
        $output = '';

        foreach ($replies as $reply) {
            $output .= $this->formatComment($reply, true);
        }

        return $output;
    }

    private function formatComment($comment, $isReply = false)
    {
        $offset = $isReply ? '2rem' : '0';
        $backgroundColor = $isReply ? '#eee' : '#ffffff'; // Change as needed
        $iconColor = $isReply ? '#007f3f' : 'orangered'; // Change as needed

        $userId = auth()->check() ? auth()->user()->id : null;

        $replyButtonAndBox = $isReply || !$userId ? '' : '
        <a href="javascript:void(0)" data-id="' . $comment->id . '" class="reply-btn" style="margin-left: 57rem; margin-top: 0; font-size: 1.5rem"><i class="fa fa-comment" style="color: ' . $iconColor . ';"></i>Trả Lời</a>
        <div class="reply-box" style="display: none; margin-left: ' . $offset . ';">
            <textarea class="mt-2 form-control reply_content_' . $comment->id . '" style="width: 65%; font-size: 1.5rem; padding: 1rem; margin-left: 28rem; border-radius: 5px" rows="2"></textarea>
            <button data-comment_id="' . $comment->id . '" data-user_id="' . $userId . '" class="btn btn-primary mt-2 reply-submit" style="margin-left: 28rem">Trả Lời</button>
        </div>';

        return '
        <div class="row justify-content-center" style="margin-left: ' . $offset . '">
            <div class="col-md-8" >
                <ul>
                    <li>
                        <a style="font-size: 2rem" href="">
                            <i class="fa fa-user" style="color: ' . $iconColor . ';margin-right: 1rem;"></i>' . $comment->user->name . '
                        </a>
                    </li>
                </ul>
            </div>
            <div class="style-comment" style="background-color: ' . $backgroundColor . ';margin-left: ' . $offset . ';">                
                <div class="col-md-12">
                    <p style="font-size: 1.8rem" class="icon">
                        <i class="fa fa-clock-o" style="color: ' . $iconColor . '; "></i>' . $comment->updated_at->format('H:i:s') . '
                    </p>
                    <p style="font-size: 1.8rem" class="icon">
                        <i class="fa fa-calendar-o" style="color: ' . $iconColor . ';"></i>' . $comment->updated_at->format('Y-m-d') . '
                    </p>
                    <p style="font-size: 1.8rem; margin-left: 1rem">' . $comment->comment . '</p>
                </div>
            </div>
            <br>
            <p></p>
            ' . $replyButtonAndBox . '
        </div>';
    }

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

    public function replyComment(Request $request)
    {
        $product_id = $request->product_id;
        $user_id = $request->user_id;
        $reply_content = $request->reply_content;


        $user = User::find($user_id);

        if ($user->role != 0) {
            // Allow reply and skip other checks
            $comment = new Comment();
            $comment->comment = $reply_content;
            $comment->user_id = $user_id;
            $comment->product_id = $product_id;
            $comment->parent_id = $request->comment_id;
            $comment->save();

            return response()->json(['success' => 'Trả lời bình luận thành công!']);
        }

        // Kiểm tra xem người dùng có đơn hàng nào hoàn thành hay không
        $order = Order::where('user_id', $user_id)
            ->where('status', 'completed')
            ->first();

        if (!$order) {
            // Nếu không có đơn hàng hoàn thành, trả về lỗi
            return response()->json(['error' => 'Bạn chỉ có thể trả lời sau khi mua sản phẩm và đơn hàng đã hoàn thành. Bạn chưa có đơn hàng nào được hoàn thành!'], 403);
        }

        // Kiểm tra xem đơn hàng đã mua sản phẩm chưa
        $orderItem = OrderItem::where('order_id', $order->id)
            ->whereHas('productDetail', function ($q) use ($product_id) {
                $q->where('prd_id', $product_id);
            })
            ->first();

        if (!$orderItem) {
            // Nếu không có sản phẩm trong đơn hàng hoàn thành, trả về lỗi
            return response()->json(['error' => 'Bạn chỉ có thể trả lời sau khi mua sản phẩm này và đơn hàng đã hoàn thành.'], 403);
        }

        // Nếu tất cả điều kiện đều đúng, tiếp tục tạo bình luận
        $comment = new Comment();
        $comment->comment = $reply_content;
        $comment->user_id = $user_id;
        $comment->product_id = $product_id;
        $comment->parent_id = $request->comment_id;
        $comment->save();

        return response()->json(['success' => 'Trả lời bình luận thành công!']);
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
