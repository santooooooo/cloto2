<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
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
     * @param  \App\Models\User  $user  投稿を取得するユーザー
     * @return \Illuminate\Http\Response
     */
    public function index(User $user = null)
    {
        if (empty($user)) {
            // 全ユーザーの投稿一覧
            $data = $this->post->latest()->get();
        } else {
            // 指定したユーザーの投稿一覧
            $data = $user->posts->sortByDesc('created_at')->values();
        }

        // サニタイジング
        $posts = [];
        foreach ($data as $post) {
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
            return response()->json(['message' => 'つぶやきの投稿に失敗しました。'], config('consts.status.INTERNAL_SERVER_ERROR'));
        }

        broadcast(new TimelineUpdated($result));
        return response()->json();
    }

    /**
     * 投稿とコメント一覧の取得
     *
     * @param  \App\Models\Post  $post  取得する投稿
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return response()->json($post->load(['comments' => function ($query) {
            $query->latest();
        }]));
    }

    /**
     * 投稿の削除
     *
     * @param  \App\Models\Post  $post  削除する投稿
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $result = $post->delete();

        if (empty($result)) {
            return response()->json(['message' => 'つぶやきの削除に失敗しました。'], config('consts.status.INTERNAL_SERVER_ERROR'));
        }

        return response()->json(['message' => 'つぶやきが削除されました。']);
    }
}
