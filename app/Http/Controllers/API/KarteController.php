<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Karte;
use App\Models\User;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KarteController extends Controller
{
    // 画像保存ディレクトリ
    const IMAGE_STORE_DIR = 'public/user/karte/';


    /** @var Karte */
    protected $karte;
    /** @var Technology */
    protected $technology;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Karte $karte, Technology $technology)
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });

        $this->karte = $karte;
        $this->technology = $technology;
    }


    /**
     * ログインユーザーが持つカルテの一覧を取得
     *
     * @return \Illuminate\Http\Response
     */
    public function index_by_auth_user()
    {
        return response()->json($this->karte->where('user_id', $this->user->id)->with('technologies')->get());
    }

    /**
     * タスクが持つカルテの一覧を取得
     *
     * @param  Int $task_id カルテを持つタスクID
     * @return \Illuminate\Http\Response
     */
    public function index_by_task_id(Int $task_id)
    {
        return response()->json($this->karte->where('task_id', $task_id)->get());
    }

    /**
     * カルテの詳細を取得
     *
     * @param  \App\Models\Karte  $karte
     * @return \Illuminate\Http\Response
     */
    public function show(Karte $karte)
    {
        return response()->json($karte);
    }

    /**
     * カルテの作成
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function post(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = $this->user->id;

        // 画像の保存
        if (!empty($request->file('image'))) {
            $save_name = $request->file('image')->hashName();
            $request->file('image')->storeAs(self::IMAGE_STORE_DIR, $save_name);

            // 現状では画像を1枚に制限
            $data['image'] = [$save_name];
        }


        $result = $this->karte->create($data);

        if (empty($result)) {
            return response(null, config('consts.status.INTERNAL_SERVER_ERROR'));
        }

        // 技術タグの紐付け
        if (!empty($data['technologies'])) {
            $result->technologies()->sync(explode(',', $data['technologies']));
        }

        return response()->json($result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Karte  $karte
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Karte $karte)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Karte  $karte
     * @return \Illuminate\Http\Response
     */
    public function destroy(Karte $karte)
    {
        //
    }
}
