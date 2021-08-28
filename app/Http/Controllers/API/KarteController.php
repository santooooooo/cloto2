<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Karte;
use App\Models\User;
use App\Models\Tag;
use App\Events\TimelineUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class KarteController extends Controller
{
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
            $this->auth = Auth::user();
            return $next($request);
        });

        $this->karte = $karte;
        $this->tag = $tag;
    }


    /**
     * カルテの一覧を取得
     *
     * @param  \App\Models\User  $user  カルテを取得するユーザー
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $kartes = $user->kartes->sortByDesc('created_at')->values();

        return response()->json($kartes);
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
        $data['user_id'] = $this->auth->id;

        // 画像ファイル名の取得
        if (!empty($request->file('image'))) {
            // 現状では画像を1枚に制限
            $filename = $request->file('image')->hashName();
            $data['image'] = [$filename];
        }

        $result = $this->karte->create($data);

        if (empty($result)) {
            return response()->json(['message' => 'カルテの保存に失敗しました。'], config('consts.status.INTERNAL_SERVER_ERROR'));
        }

        // 画像ファイルの保存（カルテの作成日時を使用するためcreate後に実行）
        if (!empty($request->file('image'))) {
            $dir = config('consts.storage.karte') . $this->auth->username . '/' . (new Carbon($result->created_at))->format('Y_md_Hi');
            $request->file('image')->storeAs($dir, $filename);
        }

        // タグの紐付け
        if (!empty($data['tags'])) {
            $result->tags()->sync(explode(',', $data['tags']));
        }

        broadcast(new TimelineUpdated($result));
        return response()->json(['message' => 'カルテが保存されました。']);
    }

    /**
     * カルテとコメント一覧の取得
     *
     * @param  \App\Models\Karte  $karte  取得するカルテ
     * @return \Illuminate\Http\Response
     */
    public function show(Karte $karte)
    {
        return response()
            ->json($karte->load(['comments' => function ($query) {
                $query->latest();
            }]));
    }

    /**
     * ユーザーごとのカルテのタグごとの割合の一覧を取得
     *
     * @param  \App\Models\User  $user  カルテを取得するユーザー
     * @return \Illuminate\Http\Response
     */
    public function graphData(User $user)
    {
        $kartes = $user->kartes->sortByDesc('created_at')->values();
        $graphData['bar'] = $this->countPerTags($kartes);
        $graphData['grass'] = $this->countPerDay($kartes);

        return response()->json($graphData);
    }

    /**
     * タグごとのカルテのパーセンテージのデータを作成
     *
     * @param  object $kartes  ユーザーのカルテ
     * @return array
     */
    public function countPerTags(object $kartes): array
    {
        $data = [];
        // カルテの総数の取得
        $max = count($kartes);

        // タグごとのカルテ数の取得
        for ($i=0;$i<$max;$i++) {
            $tags = $kartes[$i]->tags;
            $tagCount = count($tags);

            if ($tagCount === 0) {
                $data['タグなし'] = key_exists('タグなし', $data) ? $data['タグなし'] + 1 : 1 ;
                continue;
            }

            for ($s=0;$s<$tagCount;$s++) {
                $tagName = $tags[$s]->name;
                $data[$tagName] = key_exists($tagName, $data) ? $data[$tagName] + 1 : 1 ;
            }
        }

        // タグごとのカルテ数の割合の取得
        $percentage = function (int $value) use ($max) {
            return round($value / $max, 2)*100;
        };
        $data = array_map($percentage, $data);

        // データを降順に並び替え
        arsort($data);

        return $data;
    }

    /**
     * 日ごとのカルテの数のデータを作成
     *
     * @param  object $kartes  ユーザーのカルテ
     * @return array
     */
    public function countPerDay(object $kartes): array
    {
        $data = [];
        // カルテの総数の取得
        $max = count($kartes);

        // 日ごとのカルテの数の取得
        for ($i=0;$i<$max;$i++) {
            $date = substr(date($kartes[$i]->created_at), 0, 10);
            $data[$date] = key_exists($date, $data) ? $data[$date] + 1 : 1 ;
        }

        return $data;
    }
}
