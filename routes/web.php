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
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryPost;
use App\Http\Controllers\PostController;
use App\Http\Controllers\GalleryController;

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
Route::group(['middleware' => 'auth.roles'],function(){
    Route::get('/all-product',[ProductController::class, 'all_product']);
    Route::get('/add-product',[ProductController::class, 'add_product']);
});

Route::get('/edit-product/{product_id}',[ProductController::class, 'edit_product']);
Route::post('/update-product/{product_id}',[ProductController::class, 'update_product']);
Route::get('/delete-product/{product_id}',[ProductController::class, 'delete_product']);

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

// Check out
Route::get('/dang-nhap',[CheckoutController::class , 'login_checkout']);
Route::get('/del-fee',[CheckoutController::class, 'del_fee']);

Route::get('/logout-checkout',[CheckoutController::class, 'logout_checkout']);
Route::post('/add-customer',[CheckoutController::class, 'add_customer']);
Route::post('/order-place',[CheckoutController::class, 'order_place']);
Route::post('/login-customer',[CheckoutController::class, 'login_customer']);
Route::get('/checkout',[CheckoutController::class, 'checkout']);
Route::get('/payment',[CheckoutController::class, 'payment']);
Route::post('/save-checkout-customer',[CheckoutController::class, 'save_checkout_customer']);
Route::post('/calculate-fee',[CheckoutController::class, 'calculate_fee']);
Route::post('/select-delivery-home',[CheckoutController::class, 'select_delivery_home']);
Route::post('/confirm-order',[CheckoutController::class, 'confirm_order']);

// Order
Route::get('/manage-order',[OrderController::class, 'manage_order']);
Route::get('/view-order/{order_code}',[OrderController::class, 'view_order']);
Route::get('/print-order/{checkout_code}',[OrderController::class, 'print_order']);
Route::post('/update-order-qty',[OrderController::class, 'update_order_qty']);
Route::post('/update-qty',[OrderController::class, 'update_qty']);
// Banner 
Route::get('/manage-slider',[SliderController::class, 'manage_slider']);
Route::get('/add-slider',[SliderController::class, 'add_slider']);
Route::get('/delete-slide/{slide_id}',[SliderController::class, 'delete_slider']);
Route::post('/insert-slider',[SliderController::class, 'insert_slider']);
Route::get('/unactive-slide/{slide_id}',[SliderController::class, 'unactive_slide']);
Route::get('/active-slide/{slide_id}',[SliderController::class, 'active_slide']);

// Authentication roles
Route::get('/register-auth',[AuthController::class, 'register_auth']);
Route::post('/register',[AuthController::class, 'register']);
Route::get('/login-auth',[AuthController::class, 'login_auth']);
Route::get('/logout-auth',[AuthController::class, 'logout_auth']);
Route::post('/login',[AuthController::class, 'login']);

// Users
Route::get('/users',[UserController::class, 'index'])->middleware('auth.roles');
Route::get('/add-users',[UserController::class, 'add_users'])->middleware('auth.roles');
Route::post('/store-users',[UserController::class, 'store_users']);
Route::get('/delete-user-roles/{admin_id}',[UserController::class, 'delete_user_roles']);
Route::get('/impersonate/{admin_id}',[UserController::class, 'impersonate']);
Route::get('/impersonate-destroy',[UserController::class, 'impersonate_destroy']);
Route::post('/assign-roles',[UserController::class, 'assign_roles'])->middleware('auth.roles');
//Category Post

Route::get('/add-category-post',[CategoryPost::class, 'add_category_post']);
Route::get('/all-category-post',[CategoryPost::class, 'all_category_post']);
Route::get('/edit-category-post/{category_post_id}',[CategoryPost::class, 'edit_category_post']);

Route::post('/save-category-post',[CategoryPost::class, 'save_category_post']);
Route::post('/update-category-post/{cate_id}',[CategoryPost::class, 'update_category_post']);
Route::get('/delete-category-post/{cate_id}',[CategoryPost::class, 'delete_category_post']);

//Post
Route::get('/add-post',[PostController::class, 'add_post']);
Route::get('/all-post',[PostController::class, 'all_post']);
Route::get('/edit-post/{post_id}',[PostController::class, 'edit_post']);

Route::post('/save-post',[PostController::class, 'save_post']);
Route::post('/update-post/{cate_id}',[PostController::class, 'update_post']);
Route::get('/delete-post/{cate_id}',[PostController::class, 'delete_post']);

//Bai viet
Route::get('/danh-muc-bai-viet/{post_slug}',[PostController::class, 'danh_muc_bai_viet']);
Route::get('/bai-viet/{post_slug}',[PostController::class, 'bai_viet']);

// Gallery
Route::get('/add-gallery/{product_id}',[GalleryController::class, 'add_gallery']);
Route::post('/select-gallery',[GalleryController::class, 'select_gallery']);
Route::post('/insert-gallery/{product_id}',[GalleryController::class, 'insert_gallery']);
Route::post('/delete-gallery',[GalleryController::class, 'delete_gallery']);
Route::post('/update-gallery',[GalleryController::class, 'update_gallery']);
Route::post('/update-gallery-name',[GalleryController::class, 'update_gallery_name']);









