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

Route::post('/contact', 'API\ContactController@contact');
Route::post('/preregister', 'API\PreRegisterController@pre_register');


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
    Route::post('/logout', 'Auth\LoginController@logout');
    Route::get('/online', 'API\UserController@set_online');
    Route::get('/auth', 'API\UserController@auth');


    Route::namespace('API')->group(function () {
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
        Route::get('/rooms', 'RoomController@index');
        Route::get('/rooms/{room}', 'RoomController@show')->where('room', '[0-9]+');
        Route::get('/rooms/auth_sit', 'RoomController@auth_sit');
        Route::patch('/seats/sit/{seat}', 'SeatController@sit');
        Route::patch('/seats/leave', 'SeatController@leave');
        Route::patch('/seats/enter_call/{seat}', 'SeatController@enter_call')->where('seat', '[0-9]+');
        Route::patch('/seats/leave_call', 'SeatController@leave_call')->where('seat', '[0-9]+');


        /*
        |--------------------------------------------------------------------------
        | プロジェクト，タスク，カルテ
        |--------------------------------------------------------------------------
        */
        Route::get('/projects', 'ProjectController@index');
        Route::post('/projects', 'ProjectController@store');
        Route::get('/tasks/{project_id}', 'TaskController@index');
        Route::post('/tasks', 'TaskController@store');
        Route::patch('/tasks/start', 'TaskController@start');
        Route::get('/kartes/index_by_auth_user', 'KarteController@index_by_auth_user');
        Route::get('/kartes/index_by_task_id/{task_id}', 'KarteController@index_by_task_id');
        Route::post('/kartes', 'KarteController@store');
        Route::get('/tags', 'TagController@index');


        /*
        |--------------------------------------------------------------------------
        | 問い合わせ
        |--------------------------------------------------------------------------
        */
        Route::get('/inquiries', 'InquiryController@index');
        Route::post('/inquiries', 'InquiryController@store');
    });
});
