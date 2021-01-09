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
Route::post('/preregister', 'API\PreRegisterController@pre_register');


/*
|--------------------------------------------------------------------------
| 新規登録，ログイン
|--------------------------------------------------------------------------
*/
Route::post('/register', 'Auth\RegisterController@register');
Route::group(['middleware' => 'verified'], function () {
    // 未認証ユーザーのログインを禁止
    Route::post('/login', 'Auth\LoginController@login');
});

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
        Route::resource('users', 'UserController', ['only' => ['update']]);


        /*
        |--------------------------------------------------------------------------
        | 部屋
        |--------------------------------------------------------------------------
        */
        Route::resource('rooms', 'RoomController', ['only' => ['index', 'show']]);
        Route::get('/rooms/auth_sit', 'RoomController@auth_sit');

        Route::patch('/seats/sit/{seat}', 'SeatController@sit')->where('seat', '[0-9]+');
        Route::patch('/seats/leave', 'SeatController@leave');
        Route::patch('/seats/enter_call/{seat}', 'SeatController@enter_call')->where('seat', '[0-9]+');
        Route::patch('/seats/leave_call', 'SeatController@leave_call');


        /*
        |--------------------------------------------------------------------------
        | プロジェクト，タスク，カルテ
        |--------------------------------------------------------------------------
        */
        Route::resource('projects', 'ProjectController', ['only' => ['index', 'store']]);

        Route::resource('tasks', 'TaskController', ['only' => ['store']]);
        Route::get('/tasks/{project_id}', 'TaskController@index');
        Route::patch('/tasks/start', 'TaskController@start');

        Route::resource('kartes', 'KarteController', ['only' => ['store']]);
        Route::get('/kartes/index_by_auth_user', 'KarteController@index_by_auth_user');
        Route::get('/kartes/index_by_task_id/{task_id}', 'KarteController@index_by_task_id');

        Route::resource('tags', 'TagController', ['only' => ['index']]);


        /*
        |--------------------------------------------------------------------------
        | 問い合わせ
        |--------------------------------------------------------------------------
        */
        Route::resource('inquiries', 'InquiryController', ['only' => ['index', 'store']]);
    });
});
