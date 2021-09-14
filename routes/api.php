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
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
    Route::get('/auth', 'API\UserController@auth');


    Route::group(['middleware' => 'verified', 'namespace' => 'API'], function () {
        /*
        |--------------------------------------------------------------------------
        | ユーザー
        |--------------------------------------------------------------------------
        */
        Route::post('/status/{status?}', 'UserController@updateStatus');
        Route::get('/users/{user_param}', 'UserController@show');
        Route::post('/users/{user}/follow', 'UserController@follow')->where('user', '[0-9]+');
        Route::get('/users/{user}/follows', 'UserController@follows')->where('user', '[0-9]+');
        Route::get('/users/{user}/followers', 'UserController@followers')->where('user', '[0-9]+');
        Route::patch('/user', 'UserController@update');
        Route::get('/user/notifications', 'UserController@getNotifications');
        Route::post('/user/notifications', 'UserController@markNotificationsAsRead');
        Route::delete('/user', 'UserController@destroy');


        /*
        |--------------------------------------------------------------------------
        | 部屋，チャット
        |--------------------------------------------------------------------------
        */
        Route::resource('rooms', 'RoomController', ['only' => ['index', 'show']]);
        Route::post('/rooms/announce', 'RoomController@announce');

        Route::patch('/seats/{seat}/sit', 'SeatController@sit')->where('seat', '[0-9]+');
        Route::patch('/seats/leave', 'SeatController@leave');
        Route::patch('/seats/{seat}/move', 'SeatController@move')->where('seat', '[0-9]+');
        Route::patch('/seats/back', 'SeatController@back');

        Route::resource('chats', 'ChatController', ['only' => ['index', 'store']]);


        /*
        |--------------------------------------------------------------------------
        | ロードマップ
        |--------------------------------------------------------------------------
        */
        Route::resource('roadmaps', 'RoadmapsController', ['only' => ['store', 'show', 'update']]);


        /*
        |--------------------------------------------------------------------------
        | カルテ，タグ
        |--------------------------------------------------------------------------
        */
        Route::resource('kartes', 'KarteController', ['only' => ['store', 'show']]);
        // ユーザーのカルテ一覧
        Route::get('/kartes/user/{user}', 'KarteController@index')->where('user', '[0-9]+');

        // ユーザーのプロフィール欄に表示するグラフのデータ一覧
        Route::get('/graph/user/{user}', 'KarteController@graphData')->where('user', '[0-9]+');
        Route::resource('tags', 'TagController', ['only' => ['index']]);


        /*
        |--------------------------------------------------------------------------
        | 投稿
        |--------------------------------------------------------------------------
        */
        Route::resource('posts', 'PostController', ['only' => ['store', 'show', 'destroy']]);
        // ユーザーの投稿一覧
        Route::get('/posts/user/{user}', 'PostController@index')->where('user', '[0-9]+');


        /*
        |--------------------------------------------------------------------------
        | コメント
        |--------------------------------------------------------------------------
        */
        Route::resource('comments', 'CommentController', ['only' => ['store', 'destroy']]);


        /*
        |--------------------------------------------------------------------------
        | いいね
        |--------------------------------------------------------------------------
        */
        Route::resource('favorites', 'FavoriteController', ['only' => ['store', 'destroy']]);


        /*
        |--------------------------------------------------------------------------
        | タイムライン
        |--------------------------------------------------------------------------
        */
        Route::get('/timeline', 'TimelineController@index');
        // カルテ数のランキングデータの取得
        Route::get('/timeline/rank', 'TimelineController@rank');


        /*
        |--------------------------------------------------------------------------
        | 問い合わせ
        |--------------------------------------------------------------------------
        */
        Route::resource('inquiries', 'InquiryController', ['only' => ['index', 'store']]);
    });
});
