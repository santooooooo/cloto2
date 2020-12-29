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

/**
 * 管理画面
 */
Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', 'Auth\Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\Admin\LoginController@login');

    Route::group(['middleware' => 'auth:admin'], function () {
        Route::get('/{any?}', function () {
            // vue-routerで管理
            return view('admin.app');
        })->where('any', '.*');
    });
});


/**
 * ユーザーページ
 */
Route::get('/{any}', function () {
    // vue-routerで管理
    return view('app');
})->where('any', '.*');
