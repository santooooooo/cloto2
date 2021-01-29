<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Room;

class UserController extends Controller
{
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
        $this->user = $user;
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
            return response()->json(['message' => 'ユーザーの更新に失敗しました。'], config('consts.status.INTERNAL_SERVER_ERROR'));
        }

        return response()->json(['message' => 'ユーザーが更新されました。']);
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
            Storage::delete(config('consts.storage.icon') . $user->icon);
        }

        // カルテ保存ディレクトリを削除
        Storage::deleteDirectory(config('consts.storage.karte') . $user->username);

        $result = $user->delete();

        if (empty($result)) {
            return response()->json(['message' => 'ユーザーの削除に失敗しました。'], config('consts.status.INTERNAL_SERVER_ERROR'));
        }

        return response()->json(['message' => 'ユーザーが削除されました。']);
    }

    /**
     * ユーザーの強制ログアウト
     *
     * @param  \App\Models\Room $room   ログアウトさせる部屋
     * @return \Illuminate\Http\Response
     */
    public function force_logout_from_room(Room $room)
    {
        foreach ($this->user->whereNotNull('seat_id')->get() as $user) {
            if ($user->seat->section->room->id == $room->id) {
                Auth::guard('user')->logout($user);
            }
        }

        return response()->json(['message' => $room->name . 'に着席中のユーザーがログアウトされました。']);
    }
}
