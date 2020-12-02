<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // アイコン保存ディレクトリ
    const ICON_STORE_DIR = 'public/user/icon/';
    // デフォルトアイコン名
    const DEFAULT_ICON_NAME = 'default.jpg';


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

        return response()->json($this->auth_user->load(['seat.section', 'tasks' => function ($query) {
            // 進行中のタスク，プロジェクトのみを取得
            $query->where('id', $this->auth_user->task_id);
            $query->with('project');
        }]));
    }

    /**
     * ユーザーの取得
     *
     * @param   String  $user_param ユーザーIDまたはユーザー名
     * @return  User    $user       ユーザーデータ
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
     * PeerIDからユーザー名を取得
     *
     * @param   String  $peer_id    PeerID
     * @return  String  $username   ユーザー名
     */
    public function get_username_by_peer_id(String $peer_id)
    {
        $user = $this->user->where('peer_id', $peer_id)->first();
        return $user->username;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * ユーザーデータの表示
     *
     * @param  String $user_param ユーザーIDまたはユーザー名
     * @return \Illuminate\Http\Response
     */
    public function show(String $user_param)
    {
        return response()->json($this->get_user($user_param));
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
        $data['sns'] = [
            'twitter' => $data['twitter'],
            'github' => $data['github'],
            'qiita' => $data['qiita']
        ];

        // アイコンの保存
        if (!empty($request->file('icon'))) {
            // 削除処理
            if ($this->auth_user->icon != self::DEFAULT_ICON_NAME) {
                // 初期アイコン以外の場合には登録中のアイコンを削除
                Storage::delete(self::ICON_STORE_DIR . $this->auth_user->icon);
            }

            // 保存処理
            $save_name = $request->file('icon')->hashName();
            $request->file('icon')->storeAs(self::ICON_STORE_DIR, $save_name);

            $data['icon'] = $save_name;
        }


        $result = $this->auth_user->fill($data)->save();

        if (empty($result)) {
            return response(null, config('consts.status.INTERNAL_SERVER_ERROR'));
        }

        return response(null);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
