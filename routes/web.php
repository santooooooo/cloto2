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
