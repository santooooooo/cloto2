<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin;

class AdminController extends Controller
{
    /** @var Admin */
    protected $admin;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Admin $admin)
    {
        $this->middleware(function ($request, $next) {
            $this->auth_admin = Auth::guard('admin')->user();
            return $next($request);
        });

        $this->admin = $admin;
    }


    /**
     * ログイン管理者の取得
     *
     * @return \Illuminate\Http\Response
     */
    public function auth()
    {
        if (empty($this->auth_admin)) {
            return response()->json();
        }

        return response()->json($this->auth_admin);
    }

    /**
     * 管理者一覧の取得
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->admin->all());
    }

    /**
     * 管理者の作成
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        // メールアドレスのユニークチェック
        if (Validator::make($data, ['email' => ['unique:admins']])->fails()) {
            return response()->json(['message' => 'このメールアドレスは既に登録されています。'], config('consts.status.INTERNAL_SERVER_ERROR'));
        }

        // パスワードのハッシュ化
        $data['password'] = Hash::make($data['password']);

        $result = $this->admin->create($data);

        if (empty($result)) {
            return response()->json(['message' => '管理者の作成に失敗しました。'], config('consts.status.INTERNAL_SERVER_ERROR'));
        }

        return response()->json(['message' => '管理者が作成されました。']);
    }

    /**
     * 管理者の更新
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin $admin  更新する管理者
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        $data = $request->all();

        // パスワードのハッシュ化
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $result = $admin->fill($data)->save();

        if (empty($result)) {
            return response()->json(['message' => '管理者の更新に失敗しました。'], config('consts.status.INTERNAL_SERVER_ERROR'));
        }

        return response()->json(['message' => '管理者が更新されました。']);
    }

    /**
     * 管理者の削除
     *
     * @param  \App\Models\Admin  $admin  削除する管理者
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        $result = $admin->delete();

        if (empty($result)) {
            return response()->json(['message' => '管理者の削除に失敗しました。'], config('consts.status.INTERNAL_SERVER_ERROR'));
        }

        return response()->json(['message' => '管理者が削除されました。']);
    }
}
