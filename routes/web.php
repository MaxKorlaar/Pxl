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
        return redirect('user/gallery');
    });

    Route::group(['prefix' => 'user', 'namespace' => 'User', 'as' => 'user/', 'middleware' => ['auth']], function () {
        Route::get('gallery', 'GalleryController@getView')->name('gallery');
        Route::get('gallery/thumb/{image_url}.{ext}', '\App\Http\Controllers\Image\ImageController@getThumbnail')->name('image_thumbnail');

        Route::put('image/{image_url}', 'GalleryController@setImageDeletionTimestamp')->name('update_image_deletion_time');
        Route::delete('image/{image_url}', 'GalleryController@deleteImage')->name('delete_image');

        Route::get('account', 'AccountController@getView')->name('account');
        Route::put('account', 'AccountController@update')->name('update_account');
        Route::get('account/delete', 'AccountController@getDeleteView')->name('account_deletion');
        Route::delete('account', 'AccountController@delete')->name('do_delete_account');

        Route::get('preferences', 'AccountController@getPreferencesView')->name('preferences');
        Route::put('preferences', 'AccountController@updatePreferences')->name('update_preferences');

        Route::get('account/2fa', 'AccountController@get2faSetupView')->name('2fa_setup');
        Route::post('account/2fa', 'AccountController@finish2faSetup')->name('2fa_confirm');
        Route::delete('account/2fa', 'AccountController@disable2fa')->name('2fa_disable');

        Route::post('account/token', 'AccountController@resetToken')->name('reset_token');
    });

    Route::group(['middleware' => ['auth']], function () {
        Route::get('upload', 'Image\UploadController@getFormView')->name('upload');
        Route::post('upload', 'Image\UploadController@uploadImageFromSite')->name('do_upload');
    });

    Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin/', 'middleware' => ['auth', 'admin']], function () {

        Route::get('users', 'UserController@getView')->name('users');
        Route::get('users/new', 'UserController@getNewUserView')->name('new_user');
        Route::post('users/new', 'UserController@newUser')->name('create_user');

        Route::get('users/{user}', 'UserController@getEditView')->name('edit_user');
        Route::put('users/{user}', 'UserController@update')->name('update_user');

        Route::post('users/{user}/token', 'UserController@resetToken')->name('reset_token');

        Route::get('users/{user}/delete', 'UserController@getDeleteView')->name('delete_user');
        Route::delete('users/{user}', 'UserController@deleteUser')->name('do_delete_user');

        Route::get('domains', 'DomainController@getView')->name('domains');
        Route::post('domains', 'DomainController@newDomain')->name('new_domain');
        Route::get('domains/{domain}/delete', 'DomainController@getDeleteView')->name('delete_domain');
        Route::delete('domains/{domain}', 'DomainController@deleteDomain')->name('do_delete_domain');
        Route::get('settings', function () {
            abort(404);

        })->name('settings');
    });

    Route::get('help/setup', 'Help\HelpController@getSetupHelpView')->name('setup_help');
    Route::get('help/setup/sharex/{user_id}/{upload_token}.json', 'Help\HelpController@getShareXConfiguration')->name('setup_sharex_config');

    Route::get('{image_url}.{extension}', 'Image\ImageController@getImageFromUrl')->name('image_request');
    Route::get('{image_url}', 'Image\ImageController@getPreviewPage')->name('image_preview_request');
    Route::get('meta/oEmbed/{image_url}', 'Image\ImageController@getOEmbed')->name('meta/oEmbed');