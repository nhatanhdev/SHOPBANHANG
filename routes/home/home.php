<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\AdminUserController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\home\HomeController;
use App\Http\Controllers\home\CartController;
use App\Http\Controllers\home\CheckoutController;
use App\Http\Controllers\payment\PayPalController;
use App\Http\Controllers\payment\VNPayController;
use App\Http\Controllers\home\VoucherController;
use App\Http\Controllers\home\ProvinceController;
use App\Http\Controllers\home\AccountController;
use App\Http\Controllers\home\WishListController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/search',[HomeController::class, 'search'])->name('home.search');

Route::get('/product', [HomeController::class, 'product'])->name('home.product');
Route::get('/product/{slug}', [HomeController::class, 'product_slug'])->name('home.product_slug');

Route::get('/product_single/{id}', [HomeController::class, 'product_single'])->name('home.product_single')->middleware('count.view');;
Route::post('/variant_check', [HomeController::class, 'variant_check'])->name('home.variant_check');
Route::post('/add_rate', [HomeController::class, 'add_rate'])->name('home.add_rate');

Route::get('/about', [HomeController::class, 'about'])->name('home.about');
Route::get('/service',[HomeController::class, 'service'])->name('home.service');
Route::get('/service-detail/{id}',[HomeController::class, 'service_detail'])->name('home.service_detail');


Route::get('/blog',[HomeController::class, 'blog'])->name('home.blog');
Route::get('/blog-detail/{id}',[HomeController::class, 'blog_detail'])->name('home.blog_detail');
Route::get('/contact',[HomeController::class, 'contact'])->name('home.contact');
Route::get('/pricing-package',[HomeController::class, 'pricing_package'])->name('home.pricing_package');
Route::get('/history',[HomeController::class, 'history'])->name('home.history');

Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('home.checkout')->middleware('Cart');
Route::post('/checkout_order', [CheckoutController::class, 'checkout_order'])->name('home.checkout_order')->middleware('Cart');
Route::get('/complete_order/{sku}', [CheckoutController::class, 'complete_order'])->name('home.complete_order');
Route::post('/choose_payment', [CheckoutController::class, 'get_info'])->name('home.get_info');
Route::get('/checkoutSuccess', [CheckoutController::class, 'checkoutSuccess'])->name('checkoutSuccess');
Route::get('/checkoutError', [CheckoutController::class, 'checkoutError'])->name('checkoutError');

Route::get('/districts', [ProvinceController::class, 'districts'])->name('ajax.districts');
Route::get('/wards', [ProvinceController::class, 'wards'])->name('ajax.wards');

Route::get('/my-account', [AccountController::class, 'account'])->name('home.account')->middleware('login');
Route::post('/update-account/{id}', [AccountController::class, 'update_account'])->name('home.update_account')->middleware('login');
Route::post('/detail-order',[AccountController::class, 'order_detail'])->name('home.order_detail')->middleware('login');
Route::post('/cancal_order',[AccountController::class, 'cancel_order'])->name('home.cancel_order')->middleware('login');

Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::get('/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::post('/check_attr', [CartController::class, 'check_attr'])->name('cart.check_attr');
    });

    Route::prefix('wishlist')->middleware('login')->group(function () {
        Route::get('/', [WishListController::class, 'index'])->name('wishlist.index');
        Route::get('/add/{id}', [WishListController::class, 'add'])->name('wishlist.add');
        // Route::get('/remove/{id}', [WishListController::class, 'remove'])->name('wishlist.remove');
    });

Route::prefix('voucher')->middleware('Cart')->group(function () {
    Route::post('/voucher_add', [VoucherController::class, 'voucher_add'])->name('home.voucher_add');
});



