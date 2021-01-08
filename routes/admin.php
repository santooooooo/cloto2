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


    /*
    |--------------------------------------------------------------------------
    | ユーザー
    |--------------------------------------------------------------------------
    */
    Route::get('/users', 'API\Admin\UserController@index')->name('admin.users');
    Route::post('/user/update/{user}', 'API\Admin\UserController@update')->where('user', '[0-9]+')->name('admin.userUpdate');


    /*
    |--------------------------------------------------------------------------
    | 部屋
    |--------------------------------------------------------------------------
    */
    Route::get('/rooms', 'API\Admin\RoomController@index')->name('admin.rooms');
    Route::post('/room/update/{room}', 'API\Admin\RoomController@update')->where('room', '[0-9]+')->name('admin.roomUpdate');
    Route::post('/seat/update/{seat}', 'API\Admin\SeatController@update')->where('seat', '[0-9]+')->name('admin.seatUpdate');


    /*
    |--------------------------------------------------------------------------
    | 問い合わせ
    |--------------------------------------------------------------------------
    */
    Route::get('/inquiries', 'API\Admin\InquiryController@index')->name('admin.inquiries');
    Route::get('/inquiry/{user}', 'API\Admin\InquiryController@show')->where('user', '[0-9]+')->name('admin.inquiryShow');
    Route::post('/inquiry/post', 'API\Admin\InquiryController@post')->name('admin.inquiryPost');


    /*
    |--------------------------------------------------------------------------
    | タグ
    |--------------------------------------------------------------------------
    */
    Route::get('/tags', 'API\Admin\TagController@index')->name('tags');
    Route::post('/tags', 'API\Admin\TagController@store')->name('admin.tagsStore');
    Route::post('/tag/update/{tag}', 'API\Admin\TagController@update')->where('tag', '[0-9]+')->name('admin.tagUpdate');
    Route::delete('/tags/{tag}', 'API\Admin\TagController@destroy')->where('tag', '[0-9]+')->name('admin.tagsDestroy');
});
