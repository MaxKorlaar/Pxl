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
    });

    Route::group(['namespace' => 'Auth', 'as' => 'auth'], function () {
        // Controllers Within The "App\Http\Controllers\Auth" Namespace
        Route::get('/login', function () {
            return view('auth/login');
        })->name('login');

        Route::get('/register', function () {
            if (config('pxl.public_signups')) {
                return view('auth/register');
            }
            return response(view('errors.403'), 403);
        })->name('register');
    });

    Route::get('/gallery', function () {
        redirect('user/gallery');
    });

    Route::group(['prefix' => 'user'], function () {
        Route::get('gallery', function () {
            // /user/gallery
        })->name('gallery');
        Route::get('account', function () {
            // /user/account
            // My account
        })->name('my-account');
    });

    Route::get('/users', function () {
        $users = App\User::all();
        var_dump($users);
        foreach ($users as $user) {
            echo $user->name;
        }
    });