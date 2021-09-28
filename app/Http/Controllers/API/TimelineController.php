<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Karte;
use App\Models\Post;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
    /** @var Karte */
    protected $karte;
    /** @var Post */
    protected $post;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Karte $karte, Post $post)
    {
        $this->karte = $karte;
        $this->post = $post;
    }


    /**
     * タイムラインの表示データ一覧を取得
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $this->karte->all()
            ->concat($this->post->all())
            ->sortByDesc('created_at')
            ->forPage($request->page ?? 1, 25)
            ->values()
            ->toArray();

        if (empty($data)) {
            return response()->json(null, config('consts.status.NOT_FOUND'));
        }

        // サニタイジング
        $items = [];
        foreach ($data as $item) {
            $item['body'] = htmlspecialchars($item['body'], ENT_QUOTES);
            array_push($items, $item);
        }

        return response()->json($items);
    }

    /**
     * タイムライン上のカルテ数のランキングを取得
     *
     * @return \Illuminate\Http\Response
     */
    public function rank(string $category)
    {
        // ランキング作成のためのデータ
        $rank = [];

        switch ($category) {
        // 一週間のランキングに関するデータの取得
        case 'week':
         $lastWeek = mktime(0, 0, 0, date("m"), date("d") - 7, date("Y"));
         $data = $this->karte->whereDate('created_at', '>', date("Y-m-d", $lastWeek))->get();
         break;

        // 一か月のランキングに関するデータの取得
        case 'month':
         $lastMonth = mktime(0, 0, 0, date("m") - 1, date("d"), date("Y"));
         $data = $this->karte->whereDate('created_at', '>', date("Y-m-d", $lastMonth))->get();
         break;

        // 通算のランキングに関するデータの取得
        case 'all':
         $data = $this->karte->get();
         break;

        // $request->categoryに想定外の値が送られた場合、空の配列データを送信
        default:
         return response()->json($rank);
        }

        // 取得したデータの加工
        $count = count($data);
        for ($i=0;$i<$count;$i++) {
            $key = $data[$i]->user->username;
            $rank[$key] = key_exists($key, $rank) ? $rank[$key] + 1 : 1;
        }

        // データを降順で並び替える
        arsort($rank);
        // データを上位10人に絞る
        $rank = array_slice($rank, 0, 10);

        return response()->json($rank);
    }
}
