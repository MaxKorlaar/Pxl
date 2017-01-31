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
        Route::post('/forgot-password', 'ForgotPasswordController@sendResetLinkEmail')->name('do_forgot_password');

        Route::get('/reset-password/{token}', 'ResetPasswordController@showResetForm')->name('reset_password');
        Route::post('/reset-password', 'ResetPasswordController@reset')->name('do_reset_password');

        /*Route::get('/forgot-password', function () {
            return view('auth/password-reset');
        })->name('forgot-password');
        Route::get('/register', function () {
            if (config('pxl.public_signups')) {
                return view('auth/register');
            }
            return response(view('errors.403'), 403);
        })->name('register');*/
        /*
         * $this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
        $this->post('login', 'Auth\LoginController@login');
        $this->post('logout', 'Auth\LoginController@logout')->name('logout');

        // Registration Routes...
        $this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
        $this->post('register', 'Auth\RegisterController@register');

        // Password Reset Routes...
        $this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
        $this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
        $this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
        $this->post('password/reset', 'Auth\ResetPasswordController@reset');
         */
    });

    Route::get('/gallery', function () {
        redirect('user/gallery');
    });

    Route::group(['prefix' => 'user', 'namespace' => 'User', 'as' => 'user/'], function () {
        Route::get('gallery', function () {
            abort(404);
            // /user/gallery
        })->name('gallery');
        Route::get('account', function () {
            abort(404);
            // /user/account
            // My account
        })->name('my-account');
    });

    Route::get('/users', function () {
        $users = App\User::all();
        return $users;
    });


    //Route::get('/home', 'HomeController@index');
