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

// トークンの再発行
Route::get('/regenerate-token', function (Request $request) {
    $request->session()->regenerateToken();
    return response()->json();
})->name('regenerateToken');

Route::post('/contact', 'API\ContactController@contact')->name('contact');
Route::post('/preregister', 'API\PreRegisterController@pre_register')->name('preRegister');

Route::post('/register', 'Auth\RegisterController@register')->name('register');
Route::post('/login', 'Auth\LoginController@login')->name('login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/auth/user', 'API\UserController@auth')->name('authUser');
    Route::get('/auth/peer_id', 'API\UserController@auth_peer_id')->name('authPeerId');
    Route::get('/user/{user_param}', 'API\UserController@show')->name('userShow');
    Route::post('/user/update', 'API\UserController@update')->name('profileUpdate');
    Route::get('/user/get_names_by_peer_id/{peer_id}', 'API\UserController@get_names_by_peer_id')->name('getNamesByPeerId');

    Route::get('/room', 'API\RoomController@index')->name('roomIndex');
    Route::get('/room/{room_id}', 'API\RoomController@show')->name('roomShow');
    Route::post('/seat/sit/{seat}', 'API\SeatController@sit')->name('seatSit');
    Route::post('/seat/leave', 'API\SeatController@leave')->name('seatLeave');
    Route::post('/seat/enterlounge/{seat}', 'API\SeatController@enter_lounge')->name('enterLounge');
    Route::post('/seat/leavelounge/{seat}', 'API\SeatController@leave_lounge')->name('leaveLounge');

    Route::get('/project', 'API\ProjectController@index')->name('projectIndex');
    Route::post('/project/post', 'API\ProjectController@post')->name('projectPost');

    Route::get('/task/index/{project_id}', 'API\TaskController@index')->name('taskIndex');
    Route::post('/task/post', 'API\TaskController@post')->name('taskPost');
    Route::post('/task/start', 'API\TaskController@start')->name('taskStart');

    Route::get('/karte/index_by_auth_user', 'API\KarteController@index_by_auth_user')->name('karteIndexByAuthUser');
    Route::get('/karte/index_by_task_id/{task_id}', 'API\KarteController@index_by_task_id')->name('karteIndexByTaskId');
    Route::post('/karte/post', 'API\KarteController@post')->name('kartePost');

    Route::get('/technology', 'API\TechnologyController@index')->name('technologyIndex');
});
