<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
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



// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::get('/danhmuc', function() {
    dd(App\DanhMuc::find(4)->danh_muc_cha);
});
Route::get('/test', function() {
    return view('pages.cart_detail');
});
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index');

Route::post('/dangnhap', 'AuthController@login')->name('dangnhap');
Route::post('/dangky', 'AuthController@register')->name('dangky');
Route::get('/dangnhap', 'AuthController@show_login_form')->name('form-dangnhap');
Route::get('/dangky', 'AuthController@show_register_form')->name('form-dangky');

Route::get('/chitietsanpham/{id}', 'HomeController@detail')->name('detail');
Route::get('/lienhe', 'HomeController@contact_form')->name('contact');
Route::post('/lienhe', 'HomeController@contact')->name('handle_contact');
Route::get('/shop', 'SanPhamController@list')->name('list-product');
Route::get('/category/{id}', 'DanhMucController@showProductViaCategory')->name('product-via-category');
Route::get('/search', 'HomeController@search')->name('search');

Route::middleware(['auth'])->group(function () {
   Route::get('/logout', 'AuthController@logout')->name('logout');

   Route::get('/add-to-cart/{product_id}', 'GioHangController@addProductToCart')->name('add-to-cart');
   Route::get('/cart', 'GioHangController@cartDetail')->name('cart-detail');
   Route::get('/delete-product/{giohang_id}/{sanpham_id}', 'GioHangController@deleteProduct')->name('delete-product');
   Route::post('/update-cart', 'GioHangController@updateCart')->name('update-cart');
   Route::get('/dat-hang/{product_id}', 'GioHangController@datHang')->name('dat-hang');
   Route::post('/handle-dat-hang/{id}', 'GioHangController@handleDatHang')->name('handle-dat-hang');

   Route::get('/dat-hang-from-cart', 'GioHangController@datHangFromCart')->name('dat-hang-from-cart');
   Route::post('/handle-dat-hang-from-cart', 'GioHangController@handleDatHangFromCart')->name('handle-dat-hang-from-cart');
});

