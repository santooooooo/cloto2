<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/contact', 'API\ContactController@contact');


/*
|--------------------------------------------------------------------------
| 新規登録，ログイン
|--------------------------------------------------------------------------
*/
Route::post('/register', 'Auth\RegisterController@register');
Route::post('/login', 'Auth\LoginController@login');

Route::group(['middleware' => 'auth'], function () {
    /*
    |--------------------------------------------------------------------------
    | ログインユーザー
    |--------------------------------------------------------------------------
    */
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
    Route::post('/status/{status?}', 'API\UserController@updateStatus');
    Route::get('/auth', 'API\UserController@auth');


    Route::group(['middleware' => 'verified', 'namespace' => 'API'], function () {
        /*
        |--------------------------------------------------------------------------
        | ユーザー
        |--------------------------------------------------------------------------
        */
        Route::get('/users/{user_param}', 'UserController@show');
        Route::patch('/users', 'UserController@update');

        /*
        |--------------------------------------------------------------------------
        | 部屋
        |--------------------------------------------------------------------------
        */
        Route::resource('rooms', 'RoomController', ['only' => ['index', 'show']]);
        Route::post('/announce', 'RoomController@announce');
        Route::post('/post-popup', 'RoomController@postPopup');

        Route::patch('/seats/sit/{seat}', 'SeatController@sit')->where('seat', '[0-9]+');
        Route::patch('/seats/leave', 'SeatController@leave');
        Route::patch('/seats/move/{seat}', 'SeatController@move')->where('seat', '[0-9]+');
        Route::patch('/seats/back', 'SeatController@back');


        /*
        |--------------------------------------------------------------------------
        | カルテ，タグ
        |--------------------------------------------------------------------------
        */
        Route::resource('kartes', 'KarteController', ['only' => ['index', 'store']]);

        Route::resource('tags', 'TagController', ['only' => ['index']]);


        /*
        |--------------------------------------------------------------------------
        | 問い合わせ
        |--------------------------------------------------------------------------
        */
        Route::resource('inquiries', 'InquiryController', ['only' => ['index', 'store']]);


        /*
        |--------------------------------------------------------------------------
        | フォロー
        |--------------------------------------------------------------------------
        */
        Route::post('/followers/{user}/follow', 'FollowerController@follow')->where('user', '[0-9]+');
        Route::get('/followers/{user}/follow', 'FollowerController@follow_check')->where('user', '[0-9]+');
    });
});
