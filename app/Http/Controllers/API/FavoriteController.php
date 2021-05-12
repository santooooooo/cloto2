<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\Karte;
use App\Models\Post;
use App\Models\Comment;
use App\Notifications\KarteFavorited;
use App\Notifications\PostFavorited;
use App\Notifications\CommentFavorited;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /** @var Favorite */
    protected $favorite;
    /** @var Karte */
    protected $karte;
    /** @var Post */
    protected $post;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Favorite $favorite, Karte $karte, Post $post, Comment $comment)
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });

        $this->favorite = $favorite;
        $this->karte = $karte;
        $this->post = $post;
        $this->comment = $comment;
    }


    /**
     * いいねする
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response  作成したいいねのID
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = $this->user->id;

        // いいねはカルテか投稿かコメントのどれかにのみ紐づく
        if (!empty($data['karte_id'])) {
            if (!empty($data['post_id']) || !empty($data['comment_id'])) {
                return response()->json(['message' => 'いいねに失敗しました。'], config('consts.status.INTERNAL_SERVER_ERROR'));
            }
        } else if (!empty($data['post_id'])) {
            if (!empty($data['karte_id']) || !empty($data['comment_id'])) {
                return response()->json(['message' => 'いいねに失敗しました。'], config('consts.status.INTERNAL_SERVER_ERROR'));
            }
        } else if (!empty($data['comment_id'])) {
            if (!empty($data['karte_id']) || !empty($data['post_id'])) {
                return response()->json(['message' => 'いいねに失敗しました。'], config('consts.status.INTERNAL_SERVER_ERROR'));
            }
        }

        $result = $this->favorite->create($data);

        if (empty($result)) {
            return response()->json(['message' => 'いいねに失敗しました。'], config('consts.status.INTERNAL_SERVER_ERROR'));
        }

        // 通知の発行
        if (!empty($result['karte_id'])) {
            $karte = $this->karte->find($result['karte_id']);
            // 自分のカルテへのいいねでは通知を発行しない
            if ($karte->user->id != $this->user->id) {
                $karte->user->notify(new KarteFavorited($karte, $this->user));
            }
        } else if (!empty($result['post_id'])) {
            $post = $this->post->find($result['post_id']);
            // 自分の投稿へのいいねでは通知を発行しない
            if ($post->user->id != $this->user->id) {
                $post->user->notify(new PostFavorited($post, $this->user));
            }
        } else if (!empty($result['comment_id'])) {
            $comment = $this->comment->find($result['comment_id']);
            // 自分のコメントへのいいねでは通知を発行しない
            if ($comment->user->id != $this->user->id) {
                $comment->user->notify(new CommentFavorited($comment, $this->user));
            }
        }

        return response()->json($result->id);
    }

    /**
     * いいねを解除する
     *
     * @param  \App\Models\Favorite  $favorite  解除するいいね
     * @return \Illuminate\Http\Response
     */
    public function destroy(Favorite $favorite)
    {
        $result = $favorite->delete();

        if (empty($result)) {
            return response()->json(['message' => 'いいねの解除に失敗しました。'], config('consts.status.INTERNAL_SERVER_ERROR'));
        }

        return response()->json();
    }
}
