<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Karte;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
     * タイムラインの表示データ一覧を取得
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function rank(Request $request)
    {
        switch ($request->category) {
        case 'week':
         $lastWeek = mktime(0, 0, 0, date("m"), date("d") - 7, date("Y"));
         $data = $this->karte->whereDate('created_at', '>', date("Y-m-d", $lastWeek))->get();

         $rank = [];
         $count = count($data);
         for ($i=0;$i<$count;$i++) {
             $key = $data[$i]->user->username;
             $rank[$key] = key_exists($key, $rank) ? $rank[$key] + 1 : 1;
         }

         break;

        case 'month':
         $lastMonth = mktime(0, 0, 0, date("m") - 1, date("d"), date("Y"));
         $data = $this->karte->whereDate('created_at', '>', date("Y-m-d", $lastMonth))->get();

         $rank = [];
         $count = count($data);
         for ($i=0;$i<$count;$i++) {
             $key = $data[$i]->user->username;
             $rank[$key] = key_exists($key, $rank) ? $rank[$key] + 1 : 1;
         }
         break;

        case 'all':
         $data = $this->karte->get();

         $rank = [];
         $count = count($data);
         for ($i=0;$i<$count;$i++) {
             $key = $data[$i]->user->username;
             $rank[$key] = key_exists($key, $rank) ? $rank[$key] + 1 : 1;
         }
         break;
        default:
         $rank = [];
         break;
        }

        arsort($rank);

        return response()->json($rank);
    }
}
