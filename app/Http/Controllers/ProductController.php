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
use Carbon\Carbon;
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

        $commentCount = DB::table('comments')->where('product_id', $prdd->prd_id)->count();

        $rating = Rating::where('product_id', $prdd->prd_id)->avg('rating');
        $rating_count = Rating::where('product_id', $prdd->prd_id)->count();
        $rating = round($rating);

        return view('users.modun-user.productdetail', ['products' => $products, 'prdsize' => $prdsize, 'prd' => $prd, 'prdimg' => $prdimg, 'rating' => $rating, 'rating_count' => $rating_count, 'commentCount' => $commentCount, 'otherprd'  => $otherprd, 'title' => 'Product']);
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

    function formatComment($comment, $isReply = false)
    {
        $offset = $isReply ? '5rem' : '0px';
        $background = $isReply ? '#f9f9f9' : '#fff';
        $iconColor = $isReply ? 'red' : 'blue';
        $timestamp = Carbon::parse($comment['updated_at']);

        $daysAgo = $timestamp->diffInDays(Carbon::now());
        if ($daysAgo < 1) {
            Carbon::setLocale('vi'); // Đặt ngôn ngữ hiện tại là tiếng Việt
            if ($timestamp->diffInMinutes(Carbon::now()) < 60) {
                $timeAgo = $timestamp->diffInMinutes(Carbon::now()) . ' phút trước';
            } else {
                $timeAgo = $timestamp->diffForHumans(['parts' => 1]);
            }
        } elseif ($daysAgo < 2) {
            $timeAgo = '1 ngày trước';
        } else {
            $timeAgo = $daysAgo . ' ngày trước';
        }

        $userId = auth()->check() ? auth()->user()->id : null;

        $replyButton = '';
        $replyBox = '';

        // Determine whether to display reply button and reply box
        if (!$isReply && $userId) {
            $replyButton = '<small><a href="javascript:void(0)" data-id="' . $comment->id . '" class="reply-btn" style="font-size: 1.5rem; color: #777">Trả Lời</a>
</small>';
            $replyBox =
                '<div class="reply-box" style="display: none; margin-left: ' . $offset . ';">
                <textarea class="mt-2 form-control reply_content_' . $comment->id . '" style="width: 100%; font-size: 1.5rem; padding: 1rem; border-radius: 5px" rows="1"></textarea>
                <button data-comment_id="' . $comment->id . '" data-user_id="' . $userId . '" class="btn btn-primary mt-2 reply-submit" style="margin-left: 0rem; font-size: 1.2rem; width: 100px">Trả Lời</button>
            </div>';
        }

        $commentContent = '
        <div class="container mt-5">
            <div class="row d-flex justify-content-center" style="font-size: 2rem">
                    <div class="card p-3" style="background-color: ' . $background . '; margin-left: ' . $offset . ';     border: 1px solid #00000015;">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="user d-flex flex-row align-items-center">
                                <span><small class="font-weight-bold" style="color: ' . $iconColor . '">' . $comment->user->name . '</small>
                                <br>
                                    <small class="font-weight-bold" style="margin-top: 1rem">' . $comment->comment . '</small></span>
                            </div>
                            <small>' . $timeAgo . '</small>
                        </div>
                        <div class="action d-flex justify-content-between mt-2 align-items-center">
                            <div class="reply px-4">
                            </div>
                            <div class="icons align-items-center">

                            </div>
                        </div>
                </div>
                ' . $replyButton . '
                ' . $replyBox . '
            </div>
        </div>';

        return $commentContent;
    }

    public function sendComment(Request $request)
    {
        $product_id = $request->product_id;
        $user_id = $request->user_id;
        $comment_content = $request->comment_content;

        if (!$user_id) {
            // Nếu người dùng không tồn tại, trả về lỗi
            return response()->json(['error' => 'Người dùng không tồn tại']);
        }

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

        if (!$user) {
            // Nếu người dùng không tồn tại, trả về lỗi
            return response()->json(['error' => 'Người dùng không tồn tại']);
        }

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

        if (!$user_id) {
            // Nếu người dùng không tồn tại, trả về lỗi
            return response()->json(['error' => 'Người dùng không tồn tại']);
        }

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
