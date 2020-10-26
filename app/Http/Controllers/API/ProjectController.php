<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /** @var Project */
    protected $project;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Project $project)
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });

        $this->project = $project;
    }


    /**
     * ユーザーが持つプロジェクトの一覧を取得
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->project->where('user_id', $this->user->id)->get());
    }

    /**
     * プロジェクトの詳細を取得
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return response()->json($project);
    }

    /**
     * プロジェクトの作成
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function post(Request $request)
    {
        $user_id = $this->user->id;
        $name = $request->name;
        $detail = $request->detail;

        $result = $this->project->create(compact('user_id', 'name', 'detail'));

        if (empty($result)) {
            return response(null, config('consts.status.INTERNAL_SERVER_ERROR'));
        }

        return response()->json($result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }
}
