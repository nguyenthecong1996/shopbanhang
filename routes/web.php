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

Route::group(['namespace' => 'backend', 'prefix' => 'admin'], function () {
	Route::get('/dashboard', 'AdminController@dashboard');
	//category
	Route::get('/all-category', 'AdminController@allCategory');
	Route::get('/create-category', 'AdminController@createCategory');
	Route::post('/save-category', 'AdminController@saveCategory');
	Route::get('/edit-category/{id}', 'AdminController@showCategory');
	Route::post('/update-category/{id}', 'AdminController@updateCategory');
	Route::get('/delete-category/{id}', 'AdminController@deteleCategory');

	//brand
	Route::get('/all-brand', 'BrandController@allBrand');
	Route::get('/create-brand', 'BrandController@createBrand');
	Route::post('/save-brand', 'BrandController@saveBrand');
	Route::get('/edit-brand/{id}', 'BrandController@showBrand');
	Route::post('/update-brand/{id}', 'BrandController@updateBrand');
	Route::get('/delete-brand/{id}', 'BrandController@deteleBrand');

	//product
	Route::get('/all-product', 'ProductController@allProduct');
	Route::get('/create-product', 'ProductController@createProduct');
	Route::post('/save-product', 'ProductController@saveProduct');
	Route::get('/edit-product/{id}', 'ProductController@showProduct');
	Route::post('/update-product/{id}', 'ProductController@updateProduct');
	Route::get('/delete-product/{id}', 'ProductController@deteleProduct');
});

//login facebook
 Route::get('/facebook', 'SocialAuthController@redirectToProvider');
 Route::get('/facebook/callback', 'SocialAuthController@handleProviderCallback');
