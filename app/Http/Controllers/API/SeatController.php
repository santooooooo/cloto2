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
        // 着席していた座席を休憩状態に変更
        $this->user->seat()->update(['status' => 'break', 'reservation_user_id' => $this->user->id]);

        // ユーザーと休憩室の座席を紐付け
        $this->user->seat()->associate($seat);
        $this->user->save();

        // 座席状態の更新
        $result = $seat->update(['status' => 'sitting']);

        return response()->json($result);
    }

    /**
     * 休憩室入室
     *
     * @param  \App\Models\Seat  $seat  着席する座席
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
     * @param  \App\Models\Seat  $seat  戻り先の座席
     * @return \Illuminate\Http\Response
     */
    public function leave_lounge(Seat $seat)
    {
        $user_id = $this->user->id;
        $section_id = $this->user->seat->section->id;

        // 過去の発言を隠す
        $chat = Chat::where('section_id', $section_id)->where('user_id', $user_id);
        // 発言が存在する時
        if ($chat) {
            $result = $chat->update(['data' => json_encode(['text' => '削除されたメッセージです．'])]);

            if (empty($result)) {
                return response()->json(
                    'エラーが発生しました．',
                    500,
                    [],
                    JSON_UNESCAPED_UNICODE
                );
            }
        }

        // 退出システムメッセージの追加
        $type = 'system';
        $data = json_encode(['text' => $this->user->username . 'が退出しました．'], JSON_UNESCAPED_UNICODE);
        Chat::create(compact('user_id', 'section_id', 'type', 'data'));


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
