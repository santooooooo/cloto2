<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Karte;
use App\Models\User;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KarteController extends Controller
{
    // 画像保存ディレクトリ
    const IMAGE_STORE_DIR = 'public/user/karte/';


    /** @var Karte */
    protected $karte;
    /** @var Tag */
    protected $tag;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Karte $karte, Tag $tag)
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });

        $this->karte = $karte;
        $this->tag = $tag;
    }


    /**
     * ログインユーザーが持つカルテの一覧を取得
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->user->kartes()->with('tags')->get());
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
    public function store(Request $request)
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

        // タグの紐付け
        if (!empty($data['tags'])) {
            $result->tags()->sync(explode(',', $data['tags']));
        }

        return response()->json($result);
    }
}
