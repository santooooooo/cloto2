<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Events\TimelineUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /** @var Post */
    protected $post;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Post $post)
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });

        $this->post = $post;
    }


    /**
     * 投稿の一覧を取得
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // サニタイジング
        $posts = [];
        foreach ($this->post->all() as $post) {
            $post->body = htmlspecialchars($post->body, ENT_QUOTES);
            array_push($posts, $post);
        }

        return response()->json($posts);
    }

    /**
     * 投稿の作成
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = $this->user->id;

        $result = $this->post->create($data);

        if (empty($result)) {
            return response()->json(['message' => '投稿に失敗しました．．．'], config('consts.status.INTERNAL_SERVER_ERROR'));
        }

        broadcast(new TimelineUpdated($result));
        return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
