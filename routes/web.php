<?php

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Auth\loginController;
use App\Http\Controllers\userController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Stmt\Function_;


Route::get('/order', [userController::class, 'order'])->name('users.order');
Route::get('/order/detail/{id}', [userController::class, 'orderdetail'])->name('users.orderdetail');
Route::get('/order/cancel/{id}', [userController::class, 'ordercancel'])->name('users.ordercancel');
Route::post('user/update', [userController::class, 'updateacc'])->name('users.updateacc');

//
//------------------------------product----------------------------
Route::get(
    '/productdetail/{id}',
    [ProductController::class, 'prd_detail']
)->name('users.productdetail');
Route::get('/product', [ProductController::class, 'product'])->name('users.product');
Route::get('/product/{id}', [ProductController::class, 'prdbybrand'])->name('product.brand');

//------------------------------Blog----------------------------
Route::prefix('blog')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('users.blogs');
    Route::get('/{id}/{slug}', [BlogController::class, 'showBlogByCategory'])->name('users.blogs.category');
});
//------------------------Cart---------------
Route::prefix('account')->group(function () {
    Route::get('/cart', function () {
        return view('users/modun-user/cart');
    })->name('users.cart');


    Route::get('/payment', [CartController::class, 'pay'])->name('users.payment');

    Route::get('/add_cart/{id}', [userController::class, 'addcart'])->name('users.cart1');

    Route::get('/cartshop', function () {
        return view('users/modun-user/cartshop', ['title' => 'Cart']);
    })->name('users.cartshop');


    Route::get('/delete/{id}', [CartController::class, 'deletecart'])->name('cart.delete');
    Route::get('/cart/plus/{id}', [CartController::class, 'pluscart'])->name('cart.plus');
    Route::get('/cart/minus/{id}', [CartController::class, 'minuscart'])->name('cart.minus');


    Route::post('/add_cart', [CartController::class, 'addcart'])->name('cart.add');


    Route::get('/pay', function () {
        return view('users.modun-user.payment.payment');
    });

    Route::get('/success', [CartController::class, 'cartsuccess'])->name('cart.success');
});
//---------------end Cart----------------------
Route::post('/admin/product/edit/{id}', [AdminController::class, 'prd_edit'])->name('admin.prd_edit');

Route::get('/checkout', [CheckoutController::class, 'getCheckout'])->name('checkout.index');
Route::post('/checkout/order', [CheckoutController::class, 'placeOrder'])->name('checkout.place.order');
Route::post('/checkout/online', [CheckoutController::class, 'online'])->name('checkout.online');
Route::get('/momo/callback', [CheckoutController::class, 'handlePaymentResult'])->name('momo.callback');


//-------------------ADMIN------------------------
Route::prefix('admin')->middleware('level')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/chart', [AdminController::class, 'chart'])->name('chart');

    Route::resource('categories', CategoryController::class);

    //----------------Acount----------------
    Route::prefix('account')->group(function () {

        Route::get('/', [AdminController::class, 'account'])->name('admin.account');
        Route::get('/modify/{id}', [AdminController::class, 'modify'])->name('account.detail');
        Route::get('/delete/{id}', [AdminController::class, 'delete'])->name('account.delete');
        Route::post('/edit/{id}', [AdminController::class, 'edit'])->name('account.edit');
        Route::post('/img/{id}', [AdminController::class, 'image'])->name('account.image');
    });

    // Blog
    Route::prefix('blog')->group(function () {
        Route::get('/', [BlogController::class, 'index'])->name('admin.blog');

        Route::get('/category', [BlogController::class, 'category_index'])->name('admin.blog.category');
        Route::get('/category/add', [BlogController::class, 'category_add'])->name('admin.blog.category.add');
        Route::post('/category/store', [BlogController::class, 'category_store'])->name('admin.blog.category.store');
        Route::get('/category/edit/{id}', [BlogController::class, 'category_edit'])->name('admin.blog.category.edit');
        Route::put('/category/update/{id}', [BlogController::class, 'category_update'])->name('admin.blog.category.update');
        Route::delete('/category/destroy/{id}', [BlogController::class, 'category_destroy'])->name('admin.blog.category.destroy');
    });


    //-----------------Product----------------
    Route::prefix('product')->group(function () {
        Route::get('/', [AdminController::class, 'product'])->name('admin.product');
        Route::get('/{id}', [AdminController::class, 'productorderby'])->name('admin.productorderby');

        //----------------edit prd------------

        Route::get('/modify/{id}', [AdminController::class, 'prd_modify'])->name('admin.prd_detail');
        Route::post('/edit/{id}', [AdminController::class, 'prd_edit'])->name('admin.prd_edit');

        Route::get('/removeImage/{image}', [AdminController::class, 'removeImage'])->name('product.removeImage');
        Route::get('/delete/{id}', [AdminController::class, 'delete_prd'])->name('product.delete');

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
Route::get('/', [userController::class, 'index'])->name('home1');
Route::get('search', [userController::class, 'searchproduct']);

Route::get('/search', [SearchController::class,'search'])->name('search');
Route::get('/suggestions', [SearchController::class,'suggestions']);

