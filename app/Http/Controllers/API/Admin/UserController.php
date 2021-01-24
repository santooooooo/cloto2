<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class UserController extends Controller
{
    // アイコン保存ディレクトリ
    const ICON_STORE_DIR = 'public/user/icon/';
    // デフォルトアイコン名
    const DEFAULT_ICON_FILENAME = 'default.jpg';


    /** @var User */
    protected $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->middleware(function ($request, $next) {
            $this->auth_user = Auth::guard('admin')->user();
            return $next($request);
        });

        $this->user = $user;
    }


    /**
     * ログインユーザーの取得
     *
     * @return \Illuminate\Http\Response
     */
    public function auth()
    {
        if (empty($this->auth_user)) {
            return response(null);
        }

        return response()->json($this->auth_user);
    }

    /**
     * ユーザー一覧の取得
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->user->all());
    }

    /**
     * ユーザーの更新
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User $user   更新するユーザー
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = $request->all();

        // パスワードのハッシュ化
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $result = $user->fill($data)->save();

        if (empty($result)) {
            return response(null, config('consts.status.INTERNAL_SERVER_ERROR'));
        }

        return response(null);
    }

    /**
     * ユーザーの削除
     *
     * @param  \App\Models\User  $user  削除するユーザー
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // 初期アイコン以外の場合にはアイコンを削除
        if ($user->icon != self::DEFAULT_ICON_FILENAME) {
            Storage::delete(self::ICON_STORE_DIR . $user->icon);
        }

        $result = $user->delete();

        if (empty($result)) {
            return response(null, config('consts.status.INTERNAL_SERVER_ERROR'));
        }

        return response(null);
    }
}
