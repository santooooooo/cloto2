<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // アイコン保存ディレクトリ
    const ICON_STORE_DIR = 'public/user/icon/';


    /** @var User */
    protected $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    function __construct(User $user)
    {
        $this->user = $user;
    }


    /**
     * ユーザー詳細の取得
     *
     * @param   User    $user   ユーザー
     * @return  Array   ユーザー情報
     */
    static function get_user_detail(User $user)
    {
        $sns = json_decode($user->sns, true);

        return compact(
            'user',
            'sns'
        );
    }

    /**
     * ユーザーページの表示
     *
     * @param  String $username
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(String $username)
    {
        $user = get_user($username);

        return view('user.user_page', self::get_user_detail($user));
    }

    /**
     * ユーザー情報の更新
     *
     * @param  String $username
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(String $username)
    {
        return view('user.form.profile_form', self::get_user_detail(Auth::user()));
    }

    /**
     * ユーザー情報の更新
     *
     * @param  String $username
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update(UserRequest $request)
    {
        $param = $request->toArray();

        // 更新するユーザーを取得
        $edit_user = User::where('user_id', $request->user_id)->first();

        // アイコンの処理
        if (!empty($param['upload_image'])) {
            // 削除処理
            if ($edit_user->icon != 'default.jpg') {
                // 初期値以外の場合には削除
                Storage::delete(self::ICON_STORE_DIR . $edit_user->icon);
            }

            // 保存処理
            $savename = $request->file('upload_image')->hashName();
            $request->file('upload_image')->storeAs(self::ICON_STORE_DIR, $savename);

            $param['icon'] = $savename;
        }

        // SNSの処理
        $param['sns'] = array('twitter' => $param['twitter'], 'github' => $param['github'], 'qiita' => $param['qiita']);

        // データの更新
        $edit_user->update($param);

        return redirect(route('user_page', ['username' => $param['username']]))
            ->with('success', 'プロフィールを更新しました！');
    }
}
