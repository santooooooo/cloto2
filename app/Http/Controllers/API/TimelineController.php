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
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $this->karte->all()
            ->concat($this->post->all())
            ->sortByDesc('created_at')
            ->forPage($request->page ?? 1, 20)
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
}
