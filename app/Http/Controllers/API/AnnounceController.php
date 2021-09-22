<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Announce;
use Illuminate\Http\Request;

class AnnounceController extends Controller
{
    /** @var Announce */
    protected $announce;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Announce $announce)
    {
        $this->announce = $announce;
    }


    /**
     * 運営からのお知らせの一覧を取得
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $announces = $this->announce->all()
            ->sortByDesc('created_at')
            ->forPage($request->page ?? 1, 25)
            ->values()
            ->toArray();

        if (empty($data)) {
            return response()->json(null, config('consts.status.NOT_FOUND'));
        }

        return response()->json($announces);
    }
}
