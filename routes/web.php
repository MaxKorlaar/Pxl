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

    Route::get('/', function () {
        return view('welcome');
    })->name('home');
    Route::get('/about', function () {
        return view('about');
    })->name('about');
    Route::group(['namespace' => 'Auth', 'as' => 'auth/'], function () {
        // It's rather stupid that I have to add the slash to auth/ myself, for referring to the routes later with route('auth/login').
        // Controllers Within The "App\Http\Controllers\Auth" Namespace
        Route::get('/login', 'LoginController@showLoginForm')->name('login');
        Route::post('/login', 'LoginController@login')->name('do_login');

        Route::get('/logout/{token}', 'LoginController@checkLogoutToken')->name('logout');

        Route::get('/register', 'RegisterController@showRegistrationForm')->name('register');
        Route::post('/register', 'RegisterController@register')->name('do_register');

        Route::get('/forgot-password', 'ForgotPasswordController@showLinkRequestForm')->name('forgot_password');
        Route::post('/forgot-password', 'ForgotPasswordController@requestResetLinkEmail')->name('do_forgot_password');

        Route::get('/reset-password/{email}/{token}', 'ResetPasswordController@showResetForm')->name('reset_password');
        Route::post('/reset-password', 'ResetPasswordController@reset')->name('do_reset_password');

    });

    Route::get('/gallery', function () {
        redirect('user/gallery');
    });

    Route::group(['prefix' => 'user', 'namespace' => 'User', 'as' => 'user/', 'middleware' => ['auth']], function () {
        Route::get('gallery', function () {
            abort(404);
            // /user/gallery
        })->name('gallery');
        Route::get('account', 'AccountController@getView')->name('account');
        Route::put('account', 'AccountController@update')->name('update_account');
        Route::get('account/delete', 'AccountController@getDeleteView')->name('account_deletion');
        Route::delete('account', 'AccountController@delete')->name('do_delete_account');

    });

    Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin/', 'middleware' => ['auth', 'admin']], function () {

        Route::get('users', 'UserController@getView')->name('users');
        Route::get('users/edit/{user}', 'UserController@getEditView')->name('edit_user');

        Route::get('settings', function () {
            abort(404);
            // /user/account
            // My account
        })->name('settings');


    });



    //Route::get('/home', 'HomeController@index');
