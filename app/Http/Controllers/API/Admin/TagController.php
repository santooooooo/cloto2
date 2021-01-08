<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    /** @var Tag */
    protected $tag;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Tag $tag)
    {
        $this->tag = $tag;
    }


    /**
     * タグ一覧の取得
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->tag->all());
    }

    /**
     * タグの更新
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tag $tag   更新するタグ
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $data = $request->all();

        $result = $tag->fill($data)->save();

        if (empty($result)) {
            return response(null, config('consts.status.INTERNAL_SERVER_ERROR'));
        }

        return response(null);
    }
}
