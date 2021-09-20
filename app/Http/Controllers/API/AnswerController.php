<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{
    /** @var Answer */
    protected $answer;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Answer $answer)
    {
        $this->middleware(function ($request, $next) {
            $this->auth = Auth::user();
            return $next($request);
        });

        $this->answer = $answer;
    }


    /**
     * 回答の作成
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = $this->auth->id;

        $result = $this->answer->create($data);

        if (empty($result)) {
            return response()->json(['message' => '回答の投稿に失敗しました。'], config('consts.status.INTERNAL_SERVER_ERROR'));
        }

        return response()->json();
    }

    /**
     * 回答の削除
     *
     * @param  \App\Models\Answer  $answer  削除する回答
     * @return \Illuminate\Http\Response
     */
    public function destroy(Answer $answer)
    {
        $result = $answer->delete();

        if (empty($result)) {
            return response()->json(['message' => '回答の削除に失敗しました。'], config('consts.status.INTERNAL_SERVER_ERROR'));
        }

        return response()->json(['message' => '回答が削除されました。']);
    }
}
