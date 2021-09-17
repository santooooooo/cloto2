<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /** @var Question */
    protected $question;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Question $question)
    {
        $this->middleware(function ($request, $next) {
            $this->auth = Auth::user();
            return $next($request);
        });

        $this->question = $question;
    }


    /**
     * 質問の一覧を取得
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user  質問を取得するユーザー
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, User $user)
    {
        $data = $user->questions
            ->sortByDesc('created_at')
            ->forPage($request->page ?? 1, 25)
            ->values()
            ->toArray();

        if (empty($data)) {
            return response()->json(null, config('consts.status.NOT_FOUND'));
        }

        // サニタイジング
        $questions = [];
        foreach ($data as $question) {
            $question['body'] = htmlspecialchars($question['body'], ENT_QUOTES);
            array_push($questions, $question);
        }

        return response()->json($questions);
    }

    /**
     * 質問の作成
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = $this->auth->id;

        $result = $this->question->create($data);

        if (empty($result)) {
            return response()->json(['message' => 'つぶやきの質問に失敗しました。'], config('consts.status.INTERNAL_SERVER_ERROR'));
        }

        broadcast(new TimelineUpdated($result));
        return response()->json();
    }

    /**
     * 質問とコメント一覧の取得
     *
     * @param  \App\Models\Question  $question  取得する質問
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        return response()->json($question->load(['comments' => function ($query) {
            $query->latest();
        }]));
    }

    /**
     * 質問の削除
     *
     * @param  \App\Models\Question  $question  削除する質問
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $result = $question->delete();

        if (empty($result)) {
            return response()->json(['message' => 'つぶやきの削除に失敗しました。'], config('consts.status.INTERNAL_SERVER_ERROR'));
        }

        return response()->json(['message' => 'つぶやきが削除されました。']);
    }
}
