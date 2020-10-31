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

Route::group(['namespace' => 'backend'], function () {
	Route::get('/dashboard', 'AdminController@dashboard');
	//category
	Route::get('/all-category', 'AdminController@allCategory');
	Route::post('/create-category', 'AdminController@createCategory');
	Route::get('/edit-category/{id}', 'AdminController@showCategory');
	Route::post('/update-category/{id}', 'AdminController@updateCategory');
	Route::get('/delete-category/{id}', 'AdminController@deteleCategory');

});

//login facebook
 Route::get('/facebook', 'SocialAuthController@redirectToProvider');
 Route::get('/facebook/callback', 'SocialAuthController@handleProviderCallback');
