<?php

use Illuminate\Support\Facades\DB;
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

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/', 'index@index')->name('index');

//Web Routes

Route::prefix('web')->group(function () {

    //關於我們
    Route::view('about', 'web.about')->name('web.about');

    //新聞列表
    Route::get('news_list', function () {
        $All_news = DB::table('news')->orderBy('created_at', 'desc')->paginate(5);
        return view('web.news_list', compact('All_news'));
    })->name('web.news_list');

    //個別新聞
    Route::get('news/{id}', function ($id) {
        $news = DB::table('news')->where('id', $id)->get();
        return view('web.news', compact('news'));
    })->name('web.news');

    //商店
    Route::prefix('store')->group(function () {

        Route::get('/', 'StoreController@all')->name('web.store');

        Route::get('/discount', 'StoreController@discount')->name('web.store.discount');

        Route::get('/{category}', 'StoreController@category')->name('web.store.category');

        Route::post('/', 'StoreController@search')->name('web.store.search');
    });

    Route::get('product/{id}', 'ProductController@show')->name('web.product');

    //聯絡我們
    Route::view('contact', 'web.contact')->name('web.contact');

    //使用者
    Route::prefix('user')->group(function () {

        Route::get('/login', 'UserController@login_page')->name('web.user.login_page');

        Route::post('/login', 'UserController@login')->name('web.user.login');

        Route::get('/register', 'UserController@register_page')->name('web.user.register_page');

        Route::post('/register', 'UserController@register')->name('web.user.register');

        Route::get('/register_result', 'UserController@register_result_page')->name('web.user.register_result_page');

        Route::middleware('check_user_login')->group(function () {

            Route::get('/logout', 'UserController@logout')->name('web.user.logout');

            Route::get('/orders', 'UserController@orders')->name('web.user.orders');

            Route::get('/order/{id}', 'UserController@order')->name('web.user.order');

            Route::get('/order/{id}/delete_order/', 'UserController@delete_order')->name('web.user.order.delete');

            Route::get('/account', 'UserController@account')->name('web.user.account');

            Route::post('/change_password', 'UserController@update_password')->name('web.user.update_password');

            Route::post('/change_info', 'UserController@update_info')->name('web.user.update_info');
        });
    });

    //購物車
    Route::prefix('cart')->group(function () {

        Route::get('/', 'CartController@show')->name('web.cart');

        Route::post('/add', 'CartController@add')->name('web.cart.add');

        Route::middleware('check_cart_exist')->group(function () {

            Route::post('/update', 'CartController@update')->name('web.cart.update');

            Route::get('/delete/{id}', 'CartController@delete')->name('web.cart.delete');

            Route::get('/checkout_1', 'CartController@checkout_1')->name('web.cart.checkout_1');

            Route::get('/checkout_2', 'CartController@checkout_2')->name('web.cart.checkout_2');

            Route::post('/checkout_2', 'CartController@checkout_2')->name('web.cart.checkout_2');

            Route::post('/checkout_3', 'CartController@checkout_3')->name('web.cart.checkout_3');

            Route::post('/order_success', 'CartController@order_success')->name('web.cart.order_success');
        });
    });

    //LINE Pay

    Route::get('line_pay/reserve/{id}', 'PaymentController@line_pay_reserve')->name('web.line_pay.reserve');

    Route::get('line_pay/confirm', 'PaymentController@line_pay_confirm')->name('web.line_pay.confirm');

    //Opay

    Route::get('opay_request/{id}', 'PaymentController@opay_request')->name('web.opay.request');

    Route::post('opay_receive', 'PaymentController@opay_receive')->name('web.opay.receive');

    //LINE login

    Route::get('line_login', 'LoginController@line_login')->name('web.line_login');

    Route::get('line_receive', 'LoginController@line_receive')->name('web.line_receive');

    //Google login

    Route::get('google_login', 'LoginController@google_login')->name('web.google_login');

    Route::get('google_receive', 'LoginController@google_receive')->name('web.google_receive');

    //Facebook login

    Route::get('facebook_login', 'LoginController@facebook_login')->name('web.facebook_login');

    Route::get('facebook_receive', 'LoginController@facebook_receive')->name('web.facebook_receive');
});

//Admin Routes

Route::prefix('admin')->group(function () {

    Route::get('/', 'AdminController@index')->name('admin.index');

    Route::post('login', 'AdminController@admin_login')->name('admin.login');

    Route::middleware('check_admin_login')->group(function () {

        Route::get('logout', 'AdminController@admin_logout')->name('admin.logout');

        Route::resource('news', 'NewsController');

        Route::resource('products', 'ProductsController');

        Route::resource('users', 'UsersController');

        Route::resource('orders', 'OrdersController');

        Route::put('users/update_password/{user}', 'UsersController@update_password')->name('users.update_password');
    });
});
