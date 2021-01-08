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
    Route::post('/logout', 'Auth\Admin\LoginController@logout')->name('admin.logout');
    Route::get('/auth', 'API\Admin\UserController@auth')->name('admin.authUser');


    Route::namespace('API\Admin')->group(function () {
        /*
        |--------------------------------------------------------------------------
        | ユーザー
        |--------------------------------------------------------------------------
        */
        Route::get('/users', 'UserController@index')->name('admin.users');
        Route::post('/user/update/{user}', 'UserController@update')->where('user', '[0-9]+')->name('admin.userUpdate');


        /*
        |--------------------------------------------------------------------------
        | 部屋
        |--------------------------------------------------------------------------
        */
        Route::get('/rooms', 'RoomController@index')->name('admin.rooms');
        Route::post('/room/update/{room}', 'RoomController@update')->where('room', '[0-9]+')->name('admin.roomUpdate');
        Route::post('/seat/update/{seat}', 'SeatController@update')->where('seat', '[0-9]+')->name('admin.seatUpdate');


        /*
        |--------------------------------------------------------------------------
        | 問い合わせ
        |--------------------------------------------------------------------------
        */
        Route::get('/inquiries', 'InquiryController@index')->name('admin.inquiries');
        Route::get('/inquiry/{user}', 'InquiryController@show')->where('user', '[0-9]+')->name('admin.inquiryShow');
        Route::post('/inquiry/post', 'InquiryController@post')->name('admin.inquiryPost');


        /*
        |--------------------------------------------------------------------------
        | タグ
        |--------------------------------------------------------------------------
        */
        Route::get('/tags', 'TagController@index')->name('tags');
        Route::post('/tags', 'TagController@store')->name('admin.tagsStore');
        Route::post('/tag/update/{tag}', 'TagController@update')->where('tag', '[0-9]+')->name('admin.tagUpdate');
        Route::delete('/tags/{tag}', 'TagController@destroy')->where('tag', '[0-9]+')->name('admin.tagsDestroy');
    });
});
