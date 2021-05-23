<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Karte;
use App\Models\Post;
use App\Notifications\KarteCommentPosted;
use App\Notifications\PostCommentPosted;
use App\Events\NotificationPosted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /** @var Comment */
    protected $comment;
    /** @var Karte */
    protected $karte;
    /** @var Post */
    protected $post;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Comment $comment, Karte $karte, Post $post)
    {
        $this->middleware(function ($request, $next) {
            $this->auth = Auth::user();
            return $next($request);
        });

        $this->comment = $comment;
        $this->karte = $karte;
        $this->post = $post;
    }


    /**
     * コメントの作成
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = $this->auth->id;

        // コメントはカルテか投稿のどちらかにのみ紐づく
        if (!empty($data['karte_id']) && !empty($data['post_id'])) {
            return response()->json(['message' => 'コメントの投稿に失敗しました。'], config('consts.status.INTERNAL_SERVER_ERROR'));
        }

        $result = $this->comment->create($data);

        if (empty($result)) {
            return response()->json(['message' => 'コメントの投稿に失敗しました。'], config('consts.status.INTERNAL_SERVER_ERROR'));
        }

        // 通知の発行
        if (!empty($result['karte_id'])) {
            $karte = $this->karte->find($result['karte_id']);

            // カルテの投稿者への通知
            if ($karte->user->id != $this->auth->id) {
                // 自分のカルテのコメントでは通知を発行しない
                $karte->user->notify(new KarteCommentPosted($karte, $this->auth));
                broadcast(new NotificationPosted($karte->user));
            }

            // カルテのコメントの投稿者への通知
            foreach ($karte->comments->unique('user_id') as $comment) {
                if ($comment->user->id != $this->auth->id && $comment->user->id != $karte->user->id) {
                    // 自分およびカルテの投稿者へは通知しない
                    $comment->user->notify(new KarteCommentPosted($karte, $this->auth));
                    broadcast(new NotificationPosted($comment->user));
                }
            }
        } else if (!empty($result['post_id'])) {
            $post = $this->post->find($result['post_id']);

            // 投稿の投稿者への通知
            if ($post->user->id != $this->auth->id) {
                // 自分の投稿のコメントでは通知を発行しない
                $post->user->notify(new PostCommentPosted($post, $this->auth));
                broadcast(new NotificationPosted($post->user));
            }

            // 投稿のコメントの投稿者への通知
            foreach ($post->comments->unique('user_id') as $comment) {
                if ($comment->user->id != $this->auth->id && $comment->user->id != $post->user->id) {
                    // 自分および投稿の投稿者へは通知しない
                    $comment->user->notify(new PostCommentPosted($post, $this->auth));
                    broadcast(new NotificationPosted($comment->user));
                }
            }
        }

        return response()->json();
    }

    /**
     * コメントの削除
     *
     * @param  \App\Models\Comment  $comment  削除するコメント
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $result = $comment->delete();

        if (empty($result)) {
            return response()->json(['message' => 'コメントの削除に失敗しました。'], config('consts.status.INTERNAL_SERVER_ERROR'));
        }

        return response()->json(['message' => 'コメントが削除されました。']);
    }
}
