<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryProduct;
use App\Http\Controllers\BrandProduct;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\DeliveryController;

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
//Frontend
Route::get('/',[HomeController::class, 'index']);
Route::get('/trang-chu',[HomeController::class, 'index']);
Route::post('/tim-kiem',[HomeController::class, 'search']);
// Danh mục sản phẩm trang-chu
Route::get('/danh-muc/{slug_category_product}',[CategoryProduct::class, 'show_category_home']);
Route::get('/thuong-hieu/{brand_slug}',[BrandProduct::class, 'show_brand_home']);
Route::get('/chi-tiet/{product_slug}',[ProductController::class, 'details_product']);


//Backend
Route::get('/admin',[AdminController::class, 'index']);
Route::get('/dashboard',[AdminController::class, 'show_dashboard']);
Route::get('/logout',[AdminController::class, 'log_out']);
Route::post('/admin-dashboard',[AdminController::class, 'dashboard']);

//Category Product

Route::get('/add-category-product',[CategoryProduct::class, 'add_category_product']);
Route::get('/edit-category-product/{category_product_id}',[CategoryProduct::class, 'edit_category_product']);
Route::post('/update-category-product/{category_product_id}',[CategoryProduct::class, 'update_category_product']);
Route::get('/delete-category-product/{category_product_id}',[CategoryProduct::class, 'delete_category_product']);
Route::get('/all-category-product',[CategoryProduct::class, 'all_category_product']);
Route::get('/unactive-category-product/{category_product_id}',[CategoryProduct::class, 'unactive_category_product']);
Route::get('/active-category-product/{category_product_id}',[CategoryProduct::class, 'active_category_product']);
Route::post('/save-category-product',[CategoryProduct::class, 'save_category_product']);

//Brand Product

Route::get('/add-brand-product',[BrandProduct::class, 'add_brand_product']);
Route::get('/edit-brand-product/{brand_product_id}',[BrandProduct::class, 'edit_brand_product']);
Route::post('/update-brand-product/{brand_product_id}',[BrandProduct::class, 'update_brand_product']);
Route::get('/delete-brand-product/{brand_product_id}',[BrandProduct::class, 'delete_brand_product']);
Route::get('/all-brand-product',[BrandProduct::class, 'all_brand_product']);
Route::get('/unactive-brand-product/{brand_product_id}',[BrandProduct::class, 'unactive_brand_product']);
Route::get('/active-brand-product/{brand_product_id}',[BrandProduct::class, 'active_brand_product']);
Route::post('/save-brand-product',[BrandProduct::class, 'save_brand_product']);

// Product 

Route::get('/add-product',[ProductController::class, 'add_product']);
Route::get('/edit-product/{product_id}',[ProductController::class, 'edit_product']);
Route::post('/update-product/{product_id}',[ProductController::class, 'update_product']);
Route::get('/delete-product/{product_id}',[ProductController::class, 'delete_product']);
Route::get('/all-product',[ProductController::class, 'all_product']);
Route::get('/unactive-product/{product_id}',[ProductController::class, 'unactive_product']);
Route::get('/active-product/{product_id}',[ProductController::class, 'active_product']);
Route::post('/save-product',[ProductController::class, 'save_product']);

//Cart 
// Route::post('/save-cart',[CartController::class, 'save_cart']);
Route::post('/add-cart-ajax',[CartController::class, 'add_cart_ajax']);
Route::get('/gio-hang',[CartController::class, 'gio_hang']);
Route::post('/update-cart',[CartController::class, 'update_cart']);
Route::get('/del-product/{session_id}',[CartController::class, 'delete_product']);
Route::get('/del-all-product',[CartController::class, 'delete_all_product']);

//Coupon
Route::post('/check-coupon',[CartController::class, 'check_coupon']);
Route::get('/insert-coupon',[CouponController::class, 'insert_coupon']);
Route::get('/list-coupon',[CouponController::class, 'list_coupon']);
Route::get('/unset-coupon',[CouponController::class, 'unset_coupon']);
Route::get('/delete-coupon/{coupon_id}',[CouponController::class, 'delete_coupon']);
Route::post('/insert-coupon-code',[CouponController::class, 'insert_coupon_code']);

//Delivery
Route::get('/delivery',[DeliveryController::class, 'delivery']);
Route::post('/select-delivery',[DeliveryController::class, 'select_delivery']);
Route::post('/insert-delivery',[DeliveryController::class, 'insert_delivery']);
Route::post('/select-feeship',[DeliveryController::class, 'select_feeship']);
Route::post('/update-delivery',[DeliveryController::class, 'update_delivery']);

//Send Mail 
Route::get('/send-mail',[HomeController::class, 'send_mail']);      

// Login Facebook
Route::get('/login-facebook',[LoginController::class ,'login_facebook']);
Route::get('/admin/callback',[LoginController::class ,'callback_facebook']);
Route::get('/login-google',[LoginController::class ,'login_google']);
Route::get('/google/callback',[LoginController::class ,'callback_google']);









