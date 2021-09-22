<?php

namespace App\Http\Controllers\API;

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
     * 運営からのお知らせの一覧を取得
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $informations = $this->information->all()
            ->sortByDesc('created_at')
            ->forPage($request->page ?? 1, 25)
            ->values()
            ->toArray();

        if (empty($data)) {
            return response()->json(null, config('consts.status.NOT_FOUND'));
        }

        return response()->json($informations);
    }
}
