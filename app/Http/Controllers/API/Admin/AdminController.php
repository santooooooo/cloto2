<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
        $this->admin = $admin;
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
            return response(null, config('consts.status.INTERNAL_SERVER_ERROR'));
        }

        return response(null);
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
            return response(null, config('consts.status.INTERNAL_SERVER_ERROR'));
        }

        return response(null);
    }
}
