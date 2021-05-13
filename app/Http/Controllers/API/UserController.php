<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Events\SeatStatusUpdated;
use App\Notifications\UserFollowed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Carbon;

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
        $this->middleware(function ($request, $next) {
            $this->auth_user = Auth::user();
            $this->updateStatus();
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
            return response()->json();
        }

        return response()->json($this->auth_user);
    }

    /**
     * ステータスの更新
     *
     * @param  String  $status  更新するステータス
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(String $status = null)
    {
        if (empty($this->auth_user)) {
            return response()->json();
        }

        // 10分で期限切れ
        $expires_at = Carbon::now()->addMinutes(10);

        if ($status != null) {
            // ステータスの変更
            Cache::put('user-' . $this->auth_user->id, $status, $expires_at);

            if (!empty($this->auth_user->seat)) {
                broadcast(new SeatStatusUpdated($this->auth_user->room['id']));
            }
        } else {
            // 現在のステータスで更新する
            Cache::put('user-' . $this->auth_user->id, $this->auth_user->status, $expires_at);
        }

        return response()->json();
    }

    /**
     * 通知の取得
     *
     * @return \Illuminate\Http\Response
     */
    public function getNotifications()
    {
        return response()->json($this->auth_user->getNotifications());
    }

    /**
     * 通知の既読
     *
     * @return \Illuminate\Http\Response
     */
    public function markNotificationsAsRead()
    {
        $this->auth_user->unreadNotifications()->update(['read_at' => now()]);

        return $this->getNotifications();
    }

    /**
     * ユーザーの取得
     *
     * @param  String  $user_param  ユーザーIDまたはユーザー名
     * @return \App\Models\User  ユーザーデータ
     */
    public function get_user(String $user_param)
    {
        if (preg_match('/^[0-9]+$/', $user_param)) {
            $user = $this->user->where('id', $user_param)->first();
        } else {
            $user = $this->user->where('username', $user_param)->first();
        }

        return $user;
    }

    /**
     * ユーザーデータの表示
     *
     * @param  String  $user_param  ユーザーIDまたはユーザー名
     * @return \Illuminate\Http\Response
     */
    public function show(String $user_param)
    {
        $user = $this->get_user($user_param);

        // フォロー関係の追加
        $user['following'] = $this->auth_user->isFollowing($user->id);
        $user['followed'] = $this->auth_user->isFollowed($user->id);

        return response()->json($user);
    }

    /**
     * ユーザーデータの更新
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $request->all();

        // SNSデータの型変換
        if (!empty($data['sns'])) {
            $data['sns'] = json_decode($data['sns']);
        }

        // アイコンの保存
        if (!empty($request->file('icon'))) {
            // 削除処理
            if ($this->auth_user->icon != self::DEFAULT_ICON_FILENAME) {
                // 初期アイコン以外の場合には登録中のアイコンを削除
                Storage::delete(config('consts.storage.icon') . $this->auth_user->icon);
            }

            // 保存処理
            $filename = $request->file('icon')->hashName();
            $request->file('icon')->storeAs(config('consts.storage.icon'), $filename);

            $data['icon'] = $filename;
        }

        $result = $this->auth_user->fill($data)->save();

        if (empty($result)) {
            return response()->json(['message' => 'ユーザーデータの更新に失敗しました。'], config('consts.status.INTERNAL_SERVER_ERROR'));
        }

        // 取り組み中のタスクが更新された場合
        if (array_key_exists('in_progress', $data)) {
            broadcast(new SeatStatusUpdated($this->auth_user->room['id']));
            return response()->json();
        }

        return response()->json(['message' => 'ユーザーデータが更新されました。']);
    }

    /**
     * フォロー一覧の取得
     *
     * @param  \App\Models\User  $user  一覧を取得するユーザー
     * @return \Illuminate\Http\Response
     */
    public function follows(User $user)
    {
        return response()->json($user->follows);
    }

    /**
     * フォロワー一覧の取得
     *
     * @param  \App\Models\User  $user  一覧を取得するユーザー
     * @return \Illuminate\Http\Response
     */
    public function followers(User $user)
    {
        return response()->json($user->followers);
    }

    /**
     * フォロー/フォロー解除
     *
     * @param  \App\Models\User  $user  フォロー/フォロー解除するユーザー
     * @return \Illuminate\Http\Response
     */
    public function follow(User $user)
    {
        if ($this->auth_user->id == $user->id) {
            return response()->json(['message' => '自分はフォローできません。'], config('consts.status.INTERNAL_SERVER_ERROR'));
        }

        // フォロー/フォロー解除処理
        $result = $this->auth_user->follows()->toggle($user->id);

        if (empty($result)) {
            return response()->json(['message' => 'フォロー/フォロー解除に失敗しました。'], config('consts.status.INTERNAL_SERVER_ERROR'));
        }

        // フォロー時には通知を発行
        if (count($result['attached'])) {
            $user->notify(new UserFollowed($this->auth_user));
            broadcast(new NotificationPosted($user));
        }

        return $this->show($user->id);
    }
}
