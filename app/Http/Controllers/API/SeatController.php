<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Seat;
use App\Events\SeatEvent;
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
        $room_id = $seat->section->room->id;

        // 処理中止
        if ($seat->status != null) {
            $message = '他のユーザーが着席しています。';
            return response()->json($message, config('consts.status.INTERNAL_SERVER_ERROR'));
        }


        // ユーザーと座席を紐付け
        $this->user->seat()->associate($seat);
        $this->user->save();

        // 座席状態の更新
        $seat->fill(['status' => 'sitting'])->save();

        broadcast(new SeatEvent($room_id));
        return response()->json();
    }

    /**
     * 離席
     *
     * @return \Illuminate\Http\Response
     */
    public function leave()
    {
        $room_id = $this->user->seat->section->room->id;

        // 着席中の座席の状態を初期化
        $this->user->seat->fill(['status' => null, 'reservation_user_id' => null])->save();

        // ユーザーと座席を紐付け解除
        $this->user->seat()->dissociate();
        // 進行中のタスクを初期化
        $this->user->fill(['task_id' => null])->save();

        broadcast(new SeatEvent($room_id));
        return response()->json();
    }

    /**
     * 通話室入室
     *
     * @param  \App\Models\Seat  $seat  着席する座席
     * @return \Illuminate\Http\Response
     */
    public function enter_call(Seat $seat)
    {
        $room_id = $seat->section->room->id;

        // 処理中止
        if ($seat->status != null) {
            $message = '他のユーザーが着席しています。';
            return response()->json($message, config('consts.status.INTERNAL_SERVER_ERROR'));
        }


        // 現在の座席をbreakに変更
        $this->user->seat->fill(['status' => 'break', 'reservation_user_id' => $this->user->id])->save();

        // ユーザーと座席を紐付け
        $this->user->seat()->associate($seat);
        $this->user->save();

        // 座席状態の更新
        $seat->fill(['status' => 'sitting'])->save();

        broadcast(new SeatEvent($room_id));
        return response()->json();
    }

    /**
     * 通話室退室
     *
     * @param  \App\Models\Seat  $seat  戻り先の座席
     * @return \Illuminate\Http\Response
     */
    public function leave_call(Seat $seat)
    {
        $room_id = $seat->section->room->id;

        // 着席していた座席を離席状態に変更
        $this->user->seat->fill(['status' => null])->save();

        // ユーザーと座席を紐付け
        $this->user->seat()->associate($seat);
        $this->user->save();

        // 座席状態の更新
        $seat->fill(['status' => 'sitting', 'reservation_user_id' => null])->save();

        broadcast(new SeatEvent($room_id));
        return response()->json();
    }
}
