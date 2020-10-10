<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Seat;
use App\Models\Chat;
use Illuminate\Http\Request;
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
     * @return \Illuminate\Http\Response
     */
    public function leave()
    {
        // 着席中の座席状態の初期化
        $this->user->seat()->update(['status' => null, 'reservation_user_id' => null]);
        // 予約状態の座席を開放
        $this->seat->where('reservation_user_id', $this->user->id)->update(['status' => null, 'reservation_user_id' => null]);

        // ユーザーと座席を紐付け解除
        $this->user->seat()->dissociate();
        $result = $this->user->save();

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
        // 現在の座席をbreakに変更
        $this->user->seat()->update(['status' => 'break', 'reservation_user_id' => $this->user->id]);
        // ユーザーと座席を紐付け
        $this->user->seat()->associate($seat);
        $this->user->save();

        // 座席状態の更新
        $result = $seat->update(['status' => 'sitting']);

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
        if ($chat->exists()) {
            $result = $chat->update(['data' => json_encode(['text' => '削除されたメッセージです．'])]);

            if (empty($result)) {
                return response(null, config('consts.status.INTERNAL_SERVER_ERROR'));
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
        $result = $seat->update(['status' => 'sitting', 'reservation_user_id' => null]);

        return response()->json($result);
    }
}
