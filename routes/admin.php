<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Admin API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your Admin API!
|
*/

Route::group(['middleware' => 'auth:admin'], function () {
    /*
    |--------------------------------------------------------------------------
    | ログインユーザー
    |--------------------------------------------------------------------------
    */
    Route::post('/logout', 'Auth\Admin\LoginController@logout');
    Route::get('/auth', 'API\Admin\AdminController@auth');


    Route::namespace('API\Admin')->group(function () {
        /*
        |--------------------------------------------------------------------------
        | 管理者アカウント
        |--------------------------------------------------------------------------
        */
        Route::resource('admins', 'AdminController', ['only' => ['index', 'store', 'update', 'destroy']]);


        /*
        |--------------------------------------------------------------------------
        | ユーザー
        |--------------------------------------------------------------------------
        */
        Route::resource('users', 'UserController', ['only' => ['index', 'update', 'destroy']]);


        /*
        |--------------------------------------------------------------------------
        | カルテ
        |--------------------------------------------------------------------------
        */
        Route::get('/kartes/{user}', 'KarteController@show')->where('user', '[0-9]+');


        /*
        |--------------------------------------------------------------------------
        | 部屋
        |--------------------------------------------------------------------------
        */
        Route::resource('rooms', 'RoomController', ['only' => ['index', 'update']]);

        Route::resource('seats', 'SeatController', ['only' => ['update']]);


        /*
        |--------------------------------------------------------------------------
        | 運営からのお知らせ
        |--------------------------------------------------------------------------
        */
        Route::resource('informations', 'InformationController', ['only' => ['store']]);


        /*
        |--------------------------------------------------------------------------
        | 問い合わせ
        |--------------------------------------------------------------------------
        */
        Route::resource('inquiries', 'InquiryController', ['only' => ['index', 'store']]);
        Route::get('/inquiries/{user}', 'InquiryController@show')->where('user', '[0-9]+');


        /*
        |--------------------------------------------------------------------------
        | タグ
        |--------------------------------------------------------------------------
        */
        Route::resource('tags', 'TagController', ['only' => ['index', 'store', 'update', 'destroy']]);


        /*
        |--------------------------------------------------------------------------
        | イベント
        |--------------------------------------------------------------------------
        */
        Route::post('/events', 'EventController@update');


        /*
        |--------------------------------------------------------------------------
        | 一斉メール
        |--------------------------------------------------------------------------
        */
        Route::post('/newsletter', 'NewsletterController@send');
    });
});
