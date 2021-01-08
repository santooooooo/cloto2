<?php

use Illuminate\Http\Request;
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

Route::post('/contact', 'API\ContactController@contact')->name('contact');
Route::post('/preregister', 'API\PreRegisterController@pre_register')->name('preRegister');


/*
|--------------------------------------------------------------------------
| 新規登録，ログイン
|--------------------------------------------------------------------------
*/
Route::post('/register', 'Auth\RegisterController@register')->name('register');
Route::post('/login', 'Auth\LoginController@login')->name('login');


Route::group(['middleware' => 'auth'], function () {
    /*
    |--------------------------------------------------------------------------
    | ログインユーザー
    |--------------------------------------------------------------------------
    */
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
    Route::get('/online', 'API\UserController@set_online')->name('setOnline');
    Route::get('/auth/user', 'API\UserController@auth')->name('authUser');


    /*
    |--------------------------------------------------------------------------
    | ユーザー
    |--------------------------------------------------------------------------
    */
    Route::get('/user/{user_param}', 'API\UserController@show')->name('userShow');
    Route::post('/user/update', 'API\UserController@update')->name('profileUpdate');


    /*
    |--------------------------------------------------------------------------
    | 部屋
    |--------------------------------------------------------------------------
    */
    Route::get('/rooms', 'API\RoomController@index')->name('rooms');
    Route::get('/room/{room}', 'API\RoomController@show')->where('room', '[0-9]+')->name('roomShow');
    Route::get('/room/auth_sit', 'API\RoomController@auth_sit')->name('roomAuthSit');
    Route::post('/seat/sit/{seat}', 'API\SeatController@sit')->name('seatSit');
    Route::post('/seat/leave', 'API\SeatController@leave')->name('seatLeave');
    Route::post('/seat/enter_call/{seat}', 'API\SeatController@enter_call')->where('seat', '[0-9]+')->name('enterCall');
    Route::post('/seat/leave_call/{seat}', 'API\SeatController@leave_call')->where('seat', '[0-9]+')->name('leaveCall');


    /*
    |--------------------------------------------------------------------------
    | プロジェクト，タスク，カルテ
    |--------------------------------------------------------------------------
    */
    Route::get('/projects', 'API\ProjectController@index')->name('projects');
    Route::post('/project/post', 'API\ProjectController@post')->name('projectPost');
    Route::get('/tasks/{project_id}', 'API\TaskController@index')->name('tasks');
    Route::post('/task/post', 'API\TaskController@post')->name('taskPost');
    Route::post('/task/start', 'API\TaskController@start')->name('taskStart');
    Route::get('/karte/index_by_auth_user', 'API\KarteController@index_by_auth_user')->name('karteIndexByAuthUser');
    Route::get('/karte/index_by_task_id/{task_id}', 'API\KarteController@index_by_task_id')->name('karteIndexByTaskId');
    Route::post('/karte/post', 'API\KarteController@post')->name('kartePost');
    Route::get('/tags', 'API\TagController@index')->name('tags');


    /*
    |--------------------------------------------------------------------------
    | 問い合わせ
    |--------------------------------------------------------------------------
    */
    Route::get('/inquiry', 'API\InquiryController@show')->name('inquiryShow');
    Route::post('/inquiry/post', 'API\InquiryController@post')->name('inquiryPost');
});


Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
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
