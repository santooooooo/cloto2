<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

//*** トップ ***//
// Vue-routerで管理
Route::get('/', 'FrontController@index')->name('index');
Route::get('/register', 'FrontController@index')->name('register');
Route::get('/login', 'FrontController@index')->name('login');
//*** END トップ ***//


// Route::group(['middleware' => ['auth']], function () {
    Route::get('/{any}', function () {
        return view('front.index');
    })->where('any','.*');

    // //*** ユーザー ***//
    // // ユーザーページ
    // Route::get('/users/{username}', 'UserController@show')->name('user_show');

    // // プロフィール編集フォーム
    // Route::get('/users/{username}/edit', 'UserController@edit')->name('user_edit');
    // // プロフィール保存
    // Route::post('/users/update', 'UserController@update')->name('user_update');
// });