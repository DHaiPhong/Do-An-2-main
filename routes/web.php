<?php

use App\Admin\Controllers\HomeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Auth\loginController;
use App\Http\Controllers\userController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CouponController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Stmt\Function_;


//User Route
Route::middleware(['auth', 'user-role:user'])->group(function () {
    // Route::get('/role-test/user', [HomeController::class, 'roleTestUser'])->name('role.test.user');

});
// reset pass
Route::post('/change-password', [App\Http\Controllers\userController::class, 'resetpassword'])->name('resetpassword');
// Editor Route
Route::middleware(['auth', 'user-role:editor'])->group(function () {
    Route::get('/role-test/editor', [HomeController::class, 'roleTestEditor'])->name('role.test.editor');
});

// Admin Route
Route::middleware(['auth', 'user-role:admin'])->group(function () {
    Route::get('/role-test/admin', [HomeController::class, 'roleTestAdmin'])->name('role.test.admin');
});
Route::prefix('order')->group(function () {
    Route::get('/', [userController::class, 'order'])->middleware('CheckLogin')->name('users.order');
    Route::get('/detail/{id}', [userController::class, 'orderdetail'])->middleware('CheckLogin')->name('users.orderdetail');
    Route::get('/cancel/{id}', [userController::class, 'ordercancel'])->name('users.ordercancel');
    Route::post('/user/update', [userController::class, 'updateacc'])->name('users.updateacc');
});
//
//------------------------------product----------------------------
Route::get(
    '/productdetail/{id}',
    [ProductController::class, 'prd_detail']
)->name('users.productdetail');
Route::get('/product', [ProductController::class, 'product'])->name('users.product');
Route::get('/product/{slug}', [ProductController::class, 'prdbyCategory'])->name('product.category');
Route::get('/product-by-view', [ProductController::class, 'productsByViews'])->name('product.by.view');
Route::get('/product-by-sale', [ProductController::class, 'productsBySales'])->name('product.by.sale');
Route::get('/product-by-rating', [ProductController::class, 'productsByRating'])->name('product.by.rating');
Route::get('/product-by-highprice', [ProductController::class, 'productsByPriceHighToLow'])->name('product.by.highprice');
Route::get('/product-by-lowprice', [ProductController::class, 'productsByPriceLowToHigh'])->name('product.by.lowprice');

// comment in Product Detail
Route::post('/load-comment', [ProductController::class, 'loadComment'])->name('loadComment');
Route::post('/send-comment', [ProductController::class, 'sendComment'])->name('sendComment');
Route::post('/replycomment', [ProductController::class, 'replyComment']);

Route::post('/insert-rating', [ProductController::class, 'insertRating']);

//------------------------------Blog----------------------------
Route::prefix('blog')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('users.blogs');
    Route::get('/{id}/{slug}', [BlogController::class, 'showBlogByCategory'])->name('users.blogs.category');
});

Route::get('/about', [userController::class, 'about'])->name('users.about');

//------------------------Cart---------------
Route::prefix('account')->group(function () {
    //Cart
    Route::get('/cart', function () {
        return view('users/modun-user/cart');
    })->name('users.cart');
    Route::get('/add_cart/{id}', [userController::class, 'addcart'])->name('users.cart1');
    Route::get('/cartshop', [CartController::class, 'cartshop'])->name('users.cartshop');
    Route::get('/delete/{id}', [CartController::class, 'deletecart'])->name('cart.delete');
    Route::get('/cart/plus/{id}', [CartController::class, 'pluscart'])->name('cart.plus');
    Route::get('/cart/minus/{id}', [CartController::class, 'minuscart'])->name('cart.minus');
    Route::post('/add_cart', [CartController::class, 'addcart'])->name('cart.add');
    Route::get('/cart/update', [CartController::class, 'update'])->name('cart.update');

    //Payment
    Route::post('/payment', [CartController::class, 'pay'])->name('users.payment');
    Route::get('/pay', function () {
        return view('users.modun-user.payment.payment');
    });
    Route::post('/applyCoupon', [CartController::class, 'applyCoupon'])->name('applyCoupon');
    Route::get('/deleteCoupon', [CartController::class, 'deleteCoupon'])->name('deleteCoupon');

    Route::get('/success', [CartController::class, 'cartsuccess'])->name('cart.success');
});

//---------------end Cart----------------------
Route::post('/admin/product/edit/{id}', [AdminController::class, 'prd_edit'])->name('admin.prd_edit');
// Checkout
Route::get('/checkout', [CheckoutController::class, 'getCheckout'])->name('checkout.index');
Route::post('/checkout/order', [CheckoutController::class, 'placeOrder'])->name('checkout.place.order');
Route::post('/checkout/online', [CheckoutController::class, 'online'])->name('checkout.online');
Route::get('/momo/success', [CheckoutController::class, 'momoSuccess'])->name('momo.success');


//-------------------ADMIN------------------------
Route::prefix('admin')->middleware('user-role:editor,admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/chart/totalChart', [AdminController::class, 'totalChart'])->name('totalChart');
    Route::get('/chart/ordersChart', [AdminController::class, 'ordersChart'])->name('ordersChart');
    Route::get('/chart/soldChart', [AdminController::class, 'soldChart'])->name('soldChart');
    Route::get('/chart/dailyRevenueChart', [AdminController::class, 'dailyRevenueChart'])->name('dailyRevenueChart');
    Route::get('/chart/revenue-chart', [ChartController::class, 'showChart'])->name('revenue.chart');
    Route::get('/chart/revenue-chart-year', [ChartController::class, 'showChartYear'])->name('revenue.chartYear');
    Route::get('/getSoldCount', [AdminController::class, 'getSoldCount'])->name('getSoldCount');
    Route::resource('categories', CategoryController::class);
    Route::resource('coupons', CouponController::class);
    Route::resource('comments', CommentController::class);
    Route::post('/reply-comment', [CommentController::class, 'replyComment'])->name('replyComment');


    //----------------Acount----------------
    Route::prefix('account')->group(function () {
        Route::get('/', [AdminController::class, 'account'])->name('admin.account');
        Route::get('/modify/{id}', [AdminController::class, 'modify'])->name('account.detail');
        Route::get('/delete/{id}', [AdminController::class, 'delete'])->name('account.delete');
        Route::post('/edit/{id}', [AdminController::class, 'edit'])->name('account.edit');
        Route::post('/img/{id}', [AdminController::class, 'image'])->name('account.image');
    });

    // Blog
    // Route::prefix('blog')->group(function () {
    //     Route::get('/', [BlogController::class, 'index'])->name('admin.blog');

    //     Route::get('/category', [BlogController::class, 'category_index'])->name('admin.blog.category');
    //     Route::get('/category/add', [BlogController::class, 'category_add'])->name('admin.blog.category.add');
    //     Route::post('/category/store', [BlogController::class, 'category_store'])->name('admin.blog.category.store');
    //     Route::get('/category/edit/{id}', [BlogController::class, 'category_edit'])->name('admin.blog.category.edit');
    //     Route::put('/category/update/{id}', [BlogController::class, 'category_update'])->name('admin.blog.category.update');
    //     Route::delete('/category/destroy/{id}', [BlogController::class, 'category_destroy'])->name('admin.blog.category.destroy');
    // });


    //-----------------Product----------------
    Route::prefix('product')->group(function () {
        Route::get('/', [AdminController::class, 'product'])->name('admin.product');
        Route::post('/order', [AdminController::class, 'productorderby'])->name('admin.productorderby');
        Route::get('/modify/{id}', [AdminController::class, 'prd_modify'])->name('admin.prd_detail');
        Route::post('/edit/{id}', [AdminController::class, 'prd_edit'])->name('admin.prd_edit');
        Route::get('/removeImage/{image}', [AdminController::class, 'removeImage'])->name('product.removeImage');
        Route::get('/delete/{id}', [AdminController::class, 'delete_prd'])->name('product.delete');
        Route::get('/deleteSize/{id}', [AdminController::class, 'delete_size'])->name('product.deleteSize');
        //---------------add prd-----------

    });
    Route::get(
        '/checkorder',
        [AdminController::class, 'order']
    )->name('admin.order');
    Route::get('/checkorder/{id}', [AdminController::class, 'orderorderby'])->name('admin.orderorderby');

    Route::get(
        '/checkorder/orderdetail/{id}',
        [AdminController::class, 'orderdetail']
    )->name('admin.orderdetail');

    Route::get('update-status/{id}/{value}', [AdminController::class, 'updateStatus'])->name('admin.updatestatus');

    Route::get('/productt/add', [AdminController::class, 'addprdform'])->name('admin.add_prd');
    Route::post('/productt/add', [AdminController::class, 'prd_add'])->name('admin.prd_add');
});

Auth::routes();

Route::get('/home1', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/error-permission', [App\Http\Controllers\HomeController::class, 'errorPermission'])->name('errorPermission');
Route::get('/', [userController::class, 'index'])->name('home1');
Route::get('search', [userController::class, 'searchproduct']);

Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('/suggestions', [SearchController::class, 'suggestions']);

Route::get('/api/products', [AdminController::class, 'loadMoreProducts']);
