<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Star;
use Illuminate\Http\Request;

class StarController extends Controller
{
    /** @var Star */
    protected $star;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Star $star)
    {
        $this->middleware(function ($request, $next) {
            $this->auth = Auth::user();
            return $next($request);
        });

        $this->star = $star;
    }


    /**
     * スターする
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response  作成したスターのID
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = $this->auth->id;

        $result = $this->star->create($data);

        if (empty($result)) {
            return response()->json(['message' => 'スターに失敗しました。'], config('consts.status.INTERNAL_SERVER_ERROR'));
        }

        return response()->json($result->id);
    }

    /**
     * スターを解除する
     *
     * @param  \App\Models\Star  $star  解除するスター
     * @return \Illuminate\Http\Response
     */
    public function destroy(Star $star)
    {
        $result = $star->delete();

        if (empty($result)) {
            return response()->json(['message' => 'スターの解除に失敗しました。'], config('consts.status.INTERNAL_SERVER_ERROR'));
        }

        return response()->json();
    }
}
