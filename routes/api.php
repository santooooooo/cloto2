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
    Route::get('/auth/peer_id', 'API\UserController@auth_peer_id')->name('authPeerId');


    /*
    |--------------------------------------------------------------------------
    | ユーザー
    |--------------------------------------------------------------------------
    */
    Route::get('/user/{user_param}', 'API\UserController@show')->name('userShow');
    Route::post('/user/update', 'API\UserController@update')->name('profileUpdate');
    Route::get('/user/get_user_by_peer_id/{peer_id}', 'API\UserController@get_user_by_peer_id')->name('getUserByPeerId');


    /*
    |--------------------------------------------------------------------------
    | 部屋
    |--------------------------------------------------------------------------
    */
    Route::get('/rooms', 'API\RoomController@index')->name('rooms');
    Route::get('/room/{room_id}', 'API\RoomController@show')->name('roomShow');
    Route::post('/seat/sit/{seat}', 'API\SeatController@sit')->name('seatSit');
    Route::post('/seat/leave', 'API\SeatController@leave')->name('seatLeave');
    Route::post('/seat/enterlounge/{seat}', 'API\SeatController@enter_lounge')->name('enterLounge');
    Route::post('/seat/leavelounge/{seat}', 'API\SeatController@leave_lounge')->name('leaveLounge');


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
    Route::get('/technologies', 'API\TechnologyController@index')->name('technologies');


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
    Route::post('/user/update/{user_id}', 'API\Admin\UserController@update')->name('admin.userUpdate');


    /*
    |--------------------------------------------------------------------------
    | 部屋
    |--------------------------------------------------------------------------
    */
    Route::get('/rooms', 'API\Admin\RoomController@index')->name('admin.rooms');
    Route::post('/room/update/{room_id}', 'API\Admin\RoomController@update')->name('admin.roomUpdate');


    /*
    |--------------------------------------------------------------------------
    | 問い合わせ
    |--------------------------------------------------------------------------
    */
    Route::get('/inquiries', 'API\Admin\InquiryController@index')->name('admin.inquiries');
    Route::get('/inquiry/{user_id}', 'API\Admin\InquiryController@show')->name('admin.inquiryShow');
    Route::post('/inquiry/post', 'API\Admin\InquiryController@post')->name('admin.inquiryPost');
});
