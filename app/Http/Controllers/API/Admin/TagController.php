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
     * タグの作成
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $result = $this->tag->create($data);

        if (empty($result)) {
            return response()->json(['message' => 'タグの作成に失敗しました。'], config('consts.status.INTERNAL_SERVER_ERROR'));
        }

        return response()->json(['message' => 'タグが作成されました。']);
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
            return response()->json(['message' => 'タグの更新に失敗しました。'], config('consts.status.INTERNAL_SERVER_ERROR'));
        }

        return response()->json(['message' => 'タグが更新されました。']);
    }

    /**
     * タグの削除
     *
     * @param  \App\Models\Tag  $tag  削除するタグ
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $result = $tag->delete();

        if (empty($result)) {
            return response()->json(['message' => 'タグの削除に失敗しました。'], config('consts.status.INTERNAL_SERVER_ERROR'));
        }

        return response()->json(['message' => 'タグが削除されました。']);
    }
}
