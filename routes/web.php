<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/', 'App\Http\Controllers\HomeController@index');
Route::get('/trang-chu', 'App\Http\Controllers\HomeController@index');

//Danh muc san pham trang chu
Route::get('/danh-muc-san-pham/{category_product_id}', 'App\Http\Controllers\CategoryProduct@showCategoryHome');

//Thuong hieu san pham trang chu
Route::get('/thuong-hieu-san-pham/{Brand_product_id}', 'App\Http\Controllers\BrandProduct@showBrandHome');

//Chi tiet san pham
Route::get('/chi-tiet-san-pham/{product_id}', 'App\Http\Controllers\ProductController@showDetailsProduct');

//Backend
Route::get('/admin', 'App\Http\Controllers\AdminController@index');
Route::get('/dashboard', 'App\Http\Controllers\AdminController@show_dashboard');
Route::get('/logout-admin', 'App\Http\Controllers\AdminController@logout');
Route::get('/registration-admin', 'App\Http\Controllers\AdminController@registration');
Route::post('/admin-dashboard', 'App\Http\Controllers\AdminController@dashboard');
Route::post('/register-admin', 'App\Http\Controllers\AdminController@register_admin');

//Category-product
Route::get('/all-category-product', 'App\Http\Controllers\CategoryProduct@all_category_product');
Route::get('/add-category-product', 'App\Http\Controllers\CategoryProduct@add_category_product');
Route::get('/edit-category-product/{category_product_id}', 'App\Http\Controllers\CategoryProduct@edit_category_product');
Route::get('/delete-category-product/{category_product_id}', 'App\Http\Controllers\CategoryProduct@delete_category_product');
Route::get('/unactive-category-product/{category_product_id}', 'App\Http\Controllers\CategoryProduct@unactive_category_product');
Route::get('/active-category-product/{category_product_id}', 'App\Http\Controllers\CategoryProduct@active_category_product');
Route::post('/save-category-product', 'App\Http\Controllers\CategoryProduct@save_category_product');
Route::post('/update-category-product/{category_product_id}', 'App\Http\Controllers\CategoryProduct@update_category_product');

//Brand-product
Route::get('/all-Brand-product', 'App\Http\Controllers\BrandProduct@all_Brand_product');
Route::get('/add-Brand-product', 'App\Http\Controllers\BrandProduct@add_Brand_product');
Route::get('/edit-Brand-product/{Brand_product_id}', 'App\Http\Controllers\BrandProduct@edit_Brand_product');
Route::get('/delete-Brand-product/{Brand_product_id}', 'App\Http\Controllers\BrandProduct@delete_Brand_product');
Route::get('/unactive-Brand-product/{Brand_product_id}', 'App\Http\Controllers\BrandProduct@unactive_Brand_product');
Route::get('/active-Brand-product/{Brand_product_id}', 'App\Http\Controllers\BrandProduct@active_Brand_product');
Route::post('/save-Brand-product', 'App\Http\Controllers\BrandProduct@save_Brand_product');
Route::post('/update-Brand-product/{Brand_product_id}', 'App\Http\Controllers\BrandProduct@update_Brand_product');

//Product
Route::get('/all-product', 'App\Http\Controllers\ProductController@all_product');
Route::get('/add-product', 'App\Http\Controllers\ProductController@add_product');
Route::get('/edit-product/{product_id}', 'App\Http\Controllers\ProductController@edit_product');
Route::get('/delete-product/{product_id}', 'App\Http\Controllers\ProductController@delete_product');
Route::get('/unactive-product/{product_id}', 'App\Http\Controllers\ProductController@unactive_product');
Route::get('/active-product/{product_id}', 'App\Http\Controllers\ProductController@active_product');
Route::post('/save-product', 'App\Http\Controllers\ProductController@save_product');
Route::post('/update-product/{product_id}', 'App\Http\Controllers\ProductController@update_product');

//Gio hang
Route::get('/show-cart', 'App\Http\Controllers\CartController@show_cart');
Route::get('/delete-cart/{product_id}', 'App\Http\Controllers\CartController@delete_cart');
Route::post('/thanh-toan/{id}', 'App\Http\Controllers\CartController@thanh_toan');
Route::get('/show-don-hang', 'App\Http\Controllers\CartController@show_don_hang');
Route::post('/save-cart', 'App\Http\Controllers\CartController@save_cart');
Route::post('/update-cart/{product_id}', 'App\Http\Controllers\CartController@update_cart');


//Khach Hang
Route::get('/khach-hang', 'App\Http\Controllers\KHController@index');
Route::get('/logout', 'App\Http\Controllers\KHController@logout');
Route::get('/thong-tin', 'App\Http\Controllers\KHController@thong_tin');
Route::post('/login-kh', 'App\Http\Controllers\KHController@login_kh');
Route::post('/register-kh', 'App\Http\Controllers\KHController@register_kh');
Route::post('/dia-chi/{id}', 'App\Http\Controllers\KHController@dia_chi');
//update password
Route::post('/change-pass/{id}', 'App\Http\Controllers\KHController@change_pass');

//verify_mail
Route::post('/send-mail', 'App\Http\Controllers\HomeController@mail_verify_register');
Route::get('/show-verify', 'App\Http\Controllers\HomeController@show_verify');
