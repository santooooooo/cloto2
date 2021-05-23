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
            $this->auth = Auth::user();
            return $next($request);
        });

        $this->seat = $seat;
    }


    /**
     * 着席
     *
     * @param  \App\Models\Seat  $seat  着席する座席
     * @return \Illuminate\Http\Response
     */
    public function sit(Seat $seat)
    {
        $room_id = $seat->section->room_id;

        // 処理中止
        if ($seat->status != null) {
            return response()->json(['message' => '他のユーザーが着席しています。'], config('consts.status.INTERNAL_SERVER_ERROR'));
        }


        // ユーザーと座席を紐付け
        $this->auth->seat()->associate($seat);
        $this->auth->save();

        // 座席状態の更新
        $seat->fill(['status' => 'sitting'])->save();

        broadcast(new SeatStatusUpdated($room_id));
        return response()->json();
    }

    /**
     * 離席
     *
     * @return \Illuminate\Http\Response
     */
    public function leave()
    {
        $room_id = $this->auth->room['id'];

        // 着席中の座席の状態を初期化
        $this->auth->seat->fill(['status' => null, 'reservation_user_id' => null])->save();

        // ユーザーと座席を紐付け解除
        $this->auth->seat()->dissociate();
        $this->auth->save();

        // 予約中の座席の状態を初期化（念の為）
        $seat = $this->seat->where('reservation_user_id', $this->auth->id)->first();
        if (!empty($seat)) {
            $seat->fill(['status' => null, 'reservation_user_id' => null])->save();
        }

        broadcast(new SeatStatusUpdated($room_id));
        return response()->json();
    }

    /**
     * 座席の移動
     *
     * @param  \App\Models\Seat  $seat  移動先の座席
     * @return \Illuminate\Http\Response
     */
    public function move(Seat $seat)
    {
        $room_id = $seat->section->room_id;

        // 処理中止
        if ($seat->status != null) {
            return response()->json(['message' => '他のユーザーが着席しています。'], config('consts.status.INTERNAL_SERVER_ERROR'));
        }


        // 現在の座席をbreakに変更
        $this->auth->seat->fill(['status' => 'break', 'reservation_user_id' => $this->auth->id])->save();

        // ユーザーと座席を紐付け
        $this->auth->seat()->associate($seat);
        $this->auth->save();

        // 座席状態の更新
        $seat->fill(['status' => 'sitting'])->save();

        broadcast(new SeatStatusUpdated($room_id));
        return response()->json();
    }

    /**
     * 元の座席に戻る
     *
     * @return \Illuminate\Http\Response
     */
    public function back()
    {
        // 戻り先の座席を検索
        $seat = $this->seat->where('reservation_user_id', $this->auth->id)->first();
        $room_id = $seat->section->room_id;

        // 着席していた座席を離席状態に変更
        $this->auth->seat->fill(['status' => null])->save();

        // ユーザーと戻り先の座席を紐付け
        $this->auth->seat()->associate($seat);
        $this->auth->save();

        // 座席状態の更新
        $seat->fill(['status' => 'sitting', 'reservation_user_id' => null])->save();

        broadcast(new SeatStatusUpdated($room_id));
        return response()->json();
    }
}
