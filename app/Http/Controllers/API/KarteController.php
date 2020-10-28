<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Karte;
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
     * ユーザーが持つカルテの一覧を取得
     *
     * @param  Int $user_id カルテを持つユーザーID
     * @return \Illuminate\Http\Response
     */
    public function index_from_user(Int $user_id)
    {
        return response()->json($this->karte->where('user_id', $user_id)->get());
    }

    /**
     * タスクが持つカルテの一覧を取得
     *
     * @param  Int $task_id カルテを持つタスクID
     * @return \Illuminate\Http\Response
     */
    public function index_from_task(Int $task_id)
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
        $user_id = $this->user->id;
        $task_id = $request->taskId;
        $body = $request->body;
        $achieve = $request->achieve;
        $trouble = $request->trouble;
        $reference = $request->reference;
        $image = $request->image;
        $activity_time = $request->activityTime;

        // 画像の保存
        if (!empty($image)) {
            $savename = $request->file('image')->hashName();
            $request->file('image')->storeAs(self::IMAGE_STORE_DIR, $savename);

            // 現状では画像を1枚に制限
            $image = [$savename];
        }


        $result = $this->karte->create(compact(
            'user_id',
            'task_id',
            'body',
            'achieve',
            'trouble',
            'reference',
            'image',
            'activity_time'
        ));

        if (empty($result)) {
            return response(null, config('consts.status.INTERNAL_SERVER_ERROR'));
        }

        // // 技術タグの紐付け
        // if (isset($request->technologies)) {
        //     // 入力された技術タグの取得
        //     mb_regex_encoding("UTF-8");
        //     preg_match_all('/[#＃]([a-zａ-ｚA-ZＡ-Ｚ0-9０-９ぁ-んァ-ヶ一-龠!?！？@＠~～ー_-]+)/u', $request->technologies, $technologies);

        //     $technology_ids = [];
        //     // $technologies[1]には#を除いた文字列が入っている
        //     foreach ($technologies[1] as $name) {
        //         // 技術タグが存在しない場合は新規作成
        //         $technology = $this->technology->firstOrCreate(['name' => $name]);
        //         array_push($technology_ids, $technology->id);
        //     }

        //     $result->technologies()->sync($technology_ids);
        // }

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
