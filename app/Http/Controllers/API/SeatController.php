<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Seat;
use App\Models\Chat;
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
        $this->user->save();

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
        if ($seat->id != $this->user->seat_id) {
            return response()->json(
                'エラーが発生しました．',
                500,
                [],
                JSON_UNESCAPED_UNICODE
            );
        }

        // ユーザーと座席を紐付け解除
        $this->user->seat()->dissociate();
        $this->user->save();

        // 座席状態の更新
        $result = $seat->update(['status' => null]);

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
        // ユーザーと座席を紐付け
        $this->user->seat()->associate($seat);
        $this->user->save();

        // 座席状態の更新
        $result = $seat->update(['status' => 'break']);

        return response()->json($result);
    }

    /**
     * 休憩室入室
     *
     * @param  \App\Models\Seat  $seat
     * @return \Illuminate\Http\Response
     */
    public function enter_lounge(Seat $seat)
    {
        // ユーザーと座席を紐付け
        $this->user->seat()->associate($seat);
        $this->user->save();

        // 座席状態の更新
        $result = $seat->update(['status' => 'break']);

        return response()->json($result);
    }

    /**
     * 休憩室退室
     *
     * @param  \App\Models\Seat  $seat
     * @return \Illuminate\Http\Response
     */
    public function leave_lounge(Seat $seat)
    {
        $chat = Chat::where('section_id', $seat->section->id)->where('user_id', $this->user->id);

        // 発言が存在する時
        if ($chat) {
            // 発言を削除
            $result = $chat->delete();

            if (empty($result)) {
                return response()->json(
                    'エラーが発生しました．',
                    500,
                    [],
                    JSON_UNESCAPED_UNICODE
                );
            }
        }

        // 着席していた座席を離席状態に変更
        $this->user->seat()->update(['status' => null]);

        // ユーザーと座席を紐付け
        $this->user->seat()->associate($seat);
        $this->user->save();

        // 座席状態の更新
        $result = $seat->update(['status' => 'sitting']);

        return response()->json($result);
    }
}
