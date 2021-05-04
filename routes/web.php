<?php

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
Route::auth();
Route::get('auth/{provider}', 'Auth\SocialiteController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\SocialiteController@handleProviderCallback');
Route::get('/', ['uses' => 'HomeController@index']);
Route::get('home', ['uses' => 'HomeController@index']);
Route::get('locations', ['uses' => 'PageController@Location']);
Route::get('about-us', ['uses' => 'PageController@Aboutus']);
Route::get('shop', ['uses' => 'PageController@ShopFunction']);
Route::get('shop/{cat_slug}', ['uses' => 'PageController@ShopByCategory']);

 Route::group(['middleware' => ['web', 'auth', 'permission'] ], function () {

        Route::get('dashboard', ['uses' => 'HomeController@dashboard', 'as' => 'home.dashboard']);
        Route::post('dashboard', ['uses' => 'HomeController@OrderStatistics']);
        Route::post('dashboard-to-do', ['uses' => 'HomeController@OrderTodayToDoOrders']);

        //users
        Route::get('user/logout', ['uses' => 'Auth\LoginController@logout']);
        Route::resource('user', 'UserController');

        Route::get('user/{user}/permissions', ['uses' => 'UserController@permissions', 'as' => 'user.permissions']);
        Route::post('user/{user}/save', ['uses' => 'UserController@save', 'as' => 'user.save']);
        Route::get('user/{user}/activate', ['uses' => 'UserController@activate', 'as' => 'user.activate']);
        Route::get('user/{user}/deactivate', ['uses' => 'UserController@deactivate', 'as' => 'user.deactivate']);
        Route::post('user/ajax_all', ['uses' => 'UserController@ajax_all']);

        //roles
        Route::resource('role', 'RoleController');
        Route::get('role/{role}/permissions', ['uses' => 'RoleController@permissions', 'as' => 'role.permissions']);
        Route::post('role/{role}/save', ['uses' => 'RoleController@save', 'as' => 'role.save']);
        Route::post('role/check', ['uses' => 'RoleController@check']);

        //Routes
        Route::resource('location', 'LocationController');
        Route::resource('zipcode', 'zipCodeController');
        Route::resource('category', 'CategoryController');
        Route::resource('attribute', 'AttributeController');
        Route::resource('product', 'ProductController');
        //Users Account
        Route::get('my-account', ['uses' => 'MyAccountController@MyAccountIndex']);
        Route::patch('my-account/update', ['uses' => 'MyAccountController@MyAccountUpdate']);
        Route::patch('my-account/update/password', ['uses' => 'MyAccountController@MyAccountUpdatePassword']);
        Route::get('my-account/favourite', ['uses' => 'MyAccountController@MyfavouriteProducts']);
        Route::post('my-account/favourite/attach-detatch', ['uses' => 'MyAccountController@AttachDettachMyfavouriteProducts']);
         Route::get('my-account/my-orders', ['uses' => 'MyAccountController@MyOrdersProducts']);
        //Cart Routes
        Route::get('cart', ['uses' => 'CartController@index']);
        Route::delete('cart/{id}', ['uses' => 'CartController@removeItem']);
        Route::post('cart-update/{id}', ['uses' => 'CartController@updateItem']);
        Route::post('cart/addItem', ['uses' => 'CartController@addItem']);
        Route::post('cart/allowedtimes', ['uses' => 'CartController@AllowedMinMaxDate']);
        //Aplication Controller
        Route::resource('appsetting', 'AppSettingController');
        //paymentControlelr by paypal
        //paypal 
        Route::post('paypal', array('uses' => 'PaypalPaymentController@postPaymentWithpaypal'));
        Route::get('paypal', array('uses' => 'PaypalPaymentController@getPaymentStatus'));

        //Order 
        Route::resource('order', 'OrderController');
        Route::get('order/{id}/status', ['uses' => 'OrderController@StatusEnableDesable', 'as' => 'order.StatusEnableDesable']);
        //Transaction
        Route::resource('transaction', 'TransactionController');
        //Cart check
        Route::resource('cartcheck', 'CartCheckController');
        //notification
        Route::resource('notification', 'NotificationController');
        //vouchere
        Route::resource('voucher', 'VoucherController');
        Route::post('voucher-apply', ['uses' => 'VoucherController@VouchereApplyNow']);
        Route::get('voucher-apply/{cart_id}/{code_id}', ['uses' => 'VoucherController@VouchereRemoveCouponCode']);
        
});

