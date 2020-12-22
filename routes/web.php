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
    Route::get('/login', 'Auth\AdminController@showLoginForm')->name('admin_login');
    Route::post('/login', 'Auth\AdminController@login');

    Route::group(['middleware' => ['auth:admin']], function () {
        Route::post('/logout', 'Auth\AdminController@logout')->name('admin_logout');
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
