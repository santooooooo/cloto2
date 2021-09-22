<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\Information;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    /** @var Information */
    protected $information;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Information $information)
    {
        $this->information = $information;
    }


    /**
     * 運営からのお知らせの作成
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $result = $this->information->create($data);

        if (empty($result)) {
            return response()->json(['message' => 'お知らせの投稿に失敗しました。'], config('consts.status.INTERNAL_SERVER_ERROR'));
        }

        return response()->json(['message' => 'お知らせが投稿されました。']);
    }
}
