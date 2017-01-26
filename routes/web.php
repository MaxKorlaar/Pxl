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
    Route::get('/login', function () {
        return view('login');
    });

    Route::get('/register', function () {
        if(config('pxl.public_signups')) {
            return view('register');
        }
        return 403;
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