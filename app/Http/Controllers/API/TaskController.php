<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /** @var Task */
    protected $task;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Task $task)
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });

        $this->task = $task;
    }


    /**
     * プロジェクトが持つタスクの一覧を取得
     *
     * @param  Int $project_id タスクを持つプロジェクトID
     * @return \Illuminate\Http\Response
     */
    public function index(Int $project_id)
    {
        return response()->json($this->task->where('project_id', $project_id)->get());
    }

    /**
     * タスクの詳細を取得
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return response()->json($task);
    }

    /**
     * タスクの作成
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function post(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = $this->user->id;

        $result = $this->task->create($data);

        if (empty($result)) {
            return response(null, config('consts.status.INTERNAL_SERVER_ERROR'));
        }

        return response()->json($result);
    }

    /**
     * 進行中タスクの保存
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function start(Request $request)
    {
        $result = $this->user->fill($request->all())->save();

        if (empty($result)) {
            return response(null, config('consts.status.INTERNAL_SERVER_ERROR'));
        }

        return response()->json($result);
    }
}
