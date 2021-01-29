<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Seat;
use App\Events\SeatStatusUpdated;
use Illuminate\Support\Facades\Auth;

class SeatController extends Controller
{
    /** @var Seat */
    protected $seat;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Seat $seat)
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });

        $this->seat = $seat;
    }


    /**
     * 着席
     *
     * @param  \App\Models\Seat  $seat
     * @return \Illuminate\Http\Response
     */
    public function sit(Seat $seat)
    {
        $room = $seat->section->room;

        // 処理中止
        if ($seat->status != null) {
            return response()->json(['message' => '他のユーザーが着席しています。'], config('consts.status.INTERNAL_SERVER_ERROR'));
        }


        // ユーザーと座席を紐付け
        $this->user->seat()->associate($seat);
        $this->user->save();

        // 座席状態の更新
        $seat->fill(['status' => 'sitting'])->save();

        broadcast(new SeatStatusUpdated($room));
        return response()->json();
    }

    /**
     * 離席
     *
     * @return \Illuminate\Http\Response
     */
    public function leave()
    {
        $room = $this->user->seat->section->room;

        // 着席中の座席の状態を初期化
        $this->user->seat->fill(['status' => null, 'reservation_user_id' => null])->save();

        // ユーザーと座席を紐付け解除
        $this->user->seat()->dissociate();
        // 取り組み中のタスクを初期化
        $this->user->fill(['in_progress' => null])->save();

        // 予約中の座席の状態を初期化（念の為）
        $seat = $this->seat->where('reservation_user_id', $this->user->id)->first();
        if (!empty($seat)) {
            $seat->fill(['status' => null, 'reservation_user_id' => null])->save();
        }

        broadcast(new SeatStatusUpdated($room));
        return response()->json();
    }

    /**
     * 座席の移動
     *
     * @param  \App\Models\Seat  $seat  移動先の座席
     * @return \Illuminate\Http\Response
     */
    public function move_seat(Seat $seat)
    {
        $room = $seat->section->room;

        // 処理中止
        if ($seat->status != null) {
            return response()->json(['message' => '他のユーザーが着席しています。'], config('consts.status.INTERNAL_SERVER_ERROR'));
        }


        // 現在の座席をbreakに変更
        $this->user->seat->fill(['status' => 'break', 'reservation_user_id' => $this->user->id])->save();

        // ユーザーと座席を紐付け
        $this->user->seat()->associate($seat);
        $this->user->save();

        // 座席状態の更新
        $seat->fill(['status' => 'sitting'])->save();

        broadcast(new SeatStatusUpdated($room));
        return response()->json();
    }

    /**
     * 元の座席に戻る
     *
     * @return \Illuminate\Http\Response
     */
    public function return_seat()
    {
        // 戻り先の座席を検索
        $seat = $this->seat->where('reservation_user_id', $this->user->id)->first();
        $room = $seat->section->room;

        // 着席していた座席を離席状態に変更
        $this->user->seat->fill(['status' => null])->save();

        // ユーザーと戻り先の座席を紐付け
        $this->user->seat()->associate($seat);
        $this->user->save();

        // 座席状態の更新
        $seat->fill(['status' => 'sitting', 'reservation_user_id' => null])->save();

        broadcast(new SeatStatusUpdated($room));
        return response()->json();
    }
}
