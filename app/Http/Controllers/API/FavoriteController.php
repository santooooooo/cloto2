<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /** @var Favorite */
    protected $favorite;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Favorite $favorite)
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });

        $this->favorite = $favorite;
    }


    /**
     * いいねする
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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
