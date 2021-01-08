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


    Route::namespace('API')->group(function () {
        /*
        |--------------------------------------------------------------------------
        | ユーザー
        |--------------------------------------------------------------------------
        */
        Route::get('/user/{user_param}', 'UserController@show')->name('userShow');
        Route::post('/user/update', 'UserController@update')->name('profileUpdate');


        /*
        |--------------------------------------------------------------------------
        | 部屋
        |--------------------------------------------------------------------------
        */
        Route::get('/rooms', 'RoomController@index')->name('rooms');
        Route::get('/room/{room}', 'RoomController@show')->where('room', '[0-9]+')->name('roomShow');
        Route::get('/room/auth_sit', 'RoomController@auth_sit')->name('roomAuthSit');
        Route::post('/seat/sit/{seat}', 'SeatController@sit')->name('seatSit');
        Route::post('/seat/leave', 'SeatController@leave')->name('seatLeave');
        Route::post('/seat/enter_call/{seat}', 'SeatController@enter_call')->where('seat', '[0-9]+')->name('enterCall');
        Route::post('/seat/leave_call/{seat}', 'SeatController@leave_call')->where('seat', '[0-9]+')->name('leaveCall');


        /*
        |--------------------------------------------------------------------------
        | プロジェクト，タスク，カルテ
        |--------------------------------------------------------------------------
        */
        Route::get('/projects', 'ProjectController@index')->name('projects');
        Route::post('/project/post', 'ProjectController@post')->name('projectPost');
        Route::get('/tasks/{project_id}', 'TaskController@index')->name('tasks');
        Route::post('/task/post', 'TaskController@post')->name('taskPost');
        Route::post('/task/start', 'TaskController@start')->name('taskStart');
        Route::get('/karte/index_by_auth_user', 'KarteController@index_by_auth_user')->name('karteIndexByAuthUser');
        Route::get('/karte/index_by_task_id/{task_id}', 'KarteController@index_by_task_id')->name('karteIndexByTaskId');
        Route::post('/karte/post', 'KarteController@post')->name('kartePost');
        Route::get('/tags', 'TagController@index')->name('tags');


        /*
        |--------------------------------------------------------------------------
        | 問い合わせ
        |--------------------------------------------------------------------------
        */
        Route::get('/inquiry', 'InquiryController@show')->name('inquiryShow');
        Route::post('/inquiry/post', 'InquiryController@post')->name('inquiryPost');
    });
});
