<?php

use Illuminate\Http\Request;
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
    Route::get('/auth', 'API\Admin\UserController@auth');


    Route::namespace('API\Admin')->group(function () {
        /*
        |--------------------------------------------------------------------------
        | ユーザー
        |--------------------------------------------------------------------------
        */
        Route::get('/users', 'UserController@index');
        Route::patch('/users/{user}', 'UserController@update')->where('user', '[0-9]+');


        /*
        |--------------------------------------------------------------------------
        | 部屋
        |--------------------------------------------------------------------------
        */
        Route::get('/rooms', 'RoomController@index');
        Route::patch('/rooms/{room}', 'RoomController@update')->where('room', '[0-9]+');
        Route::patch('/seats/{seat}', 'SeatController@update')->where('seat', '[0-9]+');


        /*
        |--------------------------------------------------------------------------
        | 問い合わせ
        |--------------------------------------------------------------------------
        */
        Route::get('/inquiries', 'InquiryController@index');
        Route::post('/inquiries', 'InquiryController@store');
        Route::get('/inquiries/{user}', 'InquiryController@show')->where('user', '[0-9]+');


        /*
        |--------------------------------------------------------------------------
        | タグ
        |--------------------------------------------------------------------------
        */
        Route::get('/tags', 'TagController@index');
        Route::post('/tags', 'TagController@store');
        Route::patch('/tags/{tag}', 'TagController@update')->where('tag', '[0-9]+');
        Route::delete('/tags/{tag}', 'TagController@destroy')->where('tag', '[0-9]+');
    });
});
