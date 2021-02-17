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
	//login 
	Route::get('/login', 'AuthController@login');
	Route::post('/get-login', 'AuthController@getLogin');
	Route::get('/logout', 'AuthController@logOut');

	Route::get('/login-user', 'AuthController@loginUser');
	Route::post('/get-login-user', 'AuthController@getLoginUser');


	Route::get('/register', 'AuthController@getRegister');
	Route::post('/register', 'AuthController@postRegister');

Route::group(['middleware' => 'checkAdminLogin', 'namespace' => 'backend', 'prefix' => 'admin'], function () {

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

	//transport
	Route::get('/all-transport', 'FeeshipController@allTransport');
	Route::get('/get-address', 'FeeshipController@getAddress');
	Route::post('/add-fee', 'FeeshipController@addFee');
	Route::post('/edit-fee', 'FeeshipController@editFee');

	//order
	Route::post('/order-place', 'OrderController@orderPlace');
	Route::get('/all-order', 'OrderController@allOrder');
	Route::get('/detail-order/{id}', 'OrderController@detailOrder');

	//coupon
	Route::get('/all-coupon', 'CouponCotroller@allCoupon');
	Route::get('/add-coupon', 'CouponCotroller@addCoupon');
	Route::post('/save-coupon', 'CouponCotroller@saveCoupon');
	Route::get('/edit-coupon/{id}', 'CouponCotroller@editCoupon');
	Route::post('/update-coupon/{id}', 'CouponCotroller@updateCoupon');
	Route::get('/delete-coupon/{id}', 'CouponCotroller@deteleCoupon');

	//user
	Route::get('/all-user', 'UserController@allUser');
	// Route::get('/add-user', 'UserCotroller@addUser');
	// Route::post('/save-user', 'UserCotroller@saveUser');
	// Route::get('/edit-user/{id}', 'UserCotroller@editUser');
	// Route::post('/update-user/{id}', 'UserCotroller@updateUser');
	// Route::get('/delete-user/{id}', 'UserCotroller@deteleUser');

});

Route::group(['namespace' => 'front'], function () {
	Route::get('/', 'HomePageController@index');
	Route::post('cart-product', 'HomePageController@cartProduct');

	Route::get('add-cart', 'CartController@addCart');
	Route::post('change-qty', 'CartController@changeQty');
	Route::get('/remove-item', 'CartController@removeItem');

	//shiping
	Route::post('shipping_info', 'CartController@shippingInfo');

	Route::get('payment', 'CartController@Payment');

	Route::get('/check-user', 'CartController@checkUser');

	Route::get('/hand-cash', 'CartController@handCash');

	Route::get('/get-coupon', 'CartController@getCoupon');
	Route::post('/check-coupon', 'CartController@checkCoupon');
	Route::post('/search-coupon', 'CartController@searchCoupon');
	
});

//login facebook
 Route::get('/facebook', 'SocialAuthController@redirectToProvider');
 Route::get('/facebook/callback', 'SocialAuthController@handleProviderCallback');
