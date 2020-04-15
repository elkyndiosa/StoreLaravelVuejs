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
use App\Category;

Route::get('/', function () {

    return view('home');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
//cart
Route::post('/product/addCart', 'ProductController@addCart')->name('addCart');
Route::get('/product/countProdS', 'ProductController@countProdS')->name('prod.session');
Route::get('/product/getCart', 'ProductController@getCart')->name('cart.get');
Route::get('/product/deleteProductCart/{id}', 'ProductController@deleteProductCart')->name('cart.delete');
Route::get('/product/increase/{id}', 'ProductController@increase')->name('product.increase');
Route::get('/product/decrease/{id}', 'ProductController@decrease')->name('product.decrease');

//order
Route::get('/order/create/{cost}', 'OrderController@create')->name('order.create');
Route::get('/order/get', 'OrderController@get')->name('order.get');
Route::get('/order/details/{id}', 'OrderController@details')->name('order.details');
Route::get('/order/getAll', 'OrderController@getAll')->name('order.All');
Route::post('/order/changeStatus', 'OrderController@changeStatus')->name('order.changeStatus');

//product
Route::get('/admin/product', 'ProductController@index')->name('admin.product')->middleware('admin');
Route::get('/products/{page?}', 'ProductController@get')->name('get.products');
Route::get('/product/delete/{id}', 'ProductController@destroy')->name('delete.product')->middleware('admin');
Route::post('/product/create', 'ProductController@create')->name('create.product')->middleware('admin');
Route::get('/product/getImage/{id}', 'ProductController@getImage')->name('get.image');
Route::post('/product/edit', 'ProductController@edit')->name('product.edit')->middleware('admin');
Route::get('/products/category/{idcategory}/{page?}', 'ProductController@getCategory')->name('get.productsCategory');
Route::get('/products/search/{search}', 'ProductController@search')->name('product.search');

//category
Route::get('/admin/categories', 'CategoryController@index')->name('admin.categories')->middleware('admin');
Route::get('/category/all', 'CategoryController@get')->name('get.category');
Route::get('/category/admin', 'CategoryController@get')->name('get.category');
Route::get('/category/delete/{id}', 'CategoryController@destroy')->name('delete.category')->middleware('admin');
Route::post('/category/update', 'CategoryController@update')->name('product.update')->middleware('admin');
Route::post('/category/create', 'CategoryController@create')->name('product.create')->middleware('admin');

//Sliders
Route::get('/admin/slider', 'SliderController@admin')->name('slider.admin')->middleware('admin');
Route::get('/slider/delete/{id}', 'SliderController@destroy')->name('slider.delete')->middleware('admin');
Route::post('/slider/create/', 'SliderController@create')->name('slider.create')->middleware('admin');
Route::post('/slider/update/', 'SliderController@update')->name('slider.update')->middleware('admin');
Route::get('/sliders', 'SliderController@index')->name('sliders');

//users
Route::get('/user/data', 'UserControler@index')->name('user.index');
Route::post('/user/update', 'UserControler@update')->name('user.update');

//adress
Route::post('/adress/create', 'AddressController@create')->name('adress.create');

// redirect to hme
Route::get('/', 'HomeController@redirectToHome')->name('redirect.Home');
