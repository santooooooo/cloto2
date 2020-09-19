<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Seat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeatController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }


    /**
     * 着席
     *
     * @param  \App\Models\Seat  $seat
     * @return \Illuminate\Http\Response
     */
    public function sit(Seat $seat)
    {
        // ユーザーと座席を紐付け
        $this->user->seat()->associate($seat);

        // 座席状態の更新
        $result = $seat->update(['status' => 'sitting']);

        return response()->json($result);
    }

    /**
     * 離席
     *
     * @param  \App\Models\Seat  $seat
     * @return \Illuminate\Http\Response
     */
    public function leave(Seat $seat)
    {
        if ($seat->user_id != Auth::id()) {
            return response()->json(
                'エラーが発生しました．',
                500,
                [],
                JSON_UNESCAPED_UNICODE
            );
        }

        $result = $seat->update(['user_id' => null, 'status' => null]);

        return response()->json($result);
    }

    /**
     * 休憩
     *
     * @param  \App\Models\Seat  $seat
     * @return \Illuminate\Http\Response
     */
    public function break(Seat $seat)
    {
        if ($seat->user_id != Auth::id()) {
            return response()->json(
                'エラーが発生しました．',
                500,
                [],
                JSON_UNESCAPED_UNICODE
            );
        }

        $result = $seat->update(['status' => 'break']);

        return response()->json($result);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Seat  $seat
     * @return \Illuminate\Http\Response
     */
    public function show(Seat $seat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Seat  $seat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seat $seat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Seat  $seat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seat $seat)
    {
        //
    }
}
