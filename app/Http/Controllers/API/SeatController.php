<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\RoomController;
use App\Models\Seat;
use App\Models\Chat;
use Illuminate\Support\Facades\Auth;

class SeatController extends RoomController
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
            return self::show($room_id, config('consts.status.INTERNAL_SERVER_ERROR'), $message);
        }


        // ユーザーと座席を紐付け
        $this->user->seat()->associate($seat);
        $this->user->save();

        // 座席状態の更新
        $seat->fill(['status' => 'sitting'])->save();

        // 更新後の部屋データ
        return self::show($room_id);
    }

    /**
     * 離席
     *
     * @return \Illuminate\Http\Response
     */
    public function leave()
    {
        $room_id = $this->user->seat->section->room->id;

        // 着席中の座席状態の初期化
        $this->user->seat->fill(['status' => null, 'reservation_user_id' => null])->save();

        // ユーザーと座席を紐付け解除
        $this->user->seat()->dissociate();
        // 進行中のタスクを初期化
        $this->user->fill(['task_id' => null])->save();

        // 更新後の部屋データ
        return self::show($room_id);
    }

    /**
     * 休憩室入室
     *
     * @param  \App\Models\Seat  $seat  着席する座席
     * @return \Illuminate\Http\Response
     */
    public function enter_lounge(Seat $seat)
    {
        $room_id = $seat->section->room->id;

        // 処理中止
        if ($seat->status != null) {
            $message = '他のユーザーが着席しています。';
            return self::show($room_id, config('consts.status.INTERNAL_SERVER_ERROR'), $message);
        }


        // 現在の座席をbreakに変更
        $this->user->seat->fill(['status' => 'break', 'reservation_user_id' => $this->user->id])->save();

        // ユーザーと座席を紐付け
        $this->user->seat()->associate($seat);
        $this->user->save();

        // 座席状態の更新
        $seat->fill(['status' => 'sitting'])->save();

        // 更新後の部屋データ
        return self::show($room_id);
    }

    /**
     * 休憩室退室
     *
     * @param  \App\Models\Seat  $seat  戻り先の座席
     * @return \Illuminate\Http\Response
     */
    public function leave_lounge(Seat $seat)
    {
        $room_id = $seat->section->room->id;

        $user_id = $this->user->id;
        $section_id = $this->user->seat->section->id;

        // 過去の発言を隠す
        $chat = Chat::where('section_id', $section_id)->where('user_id', $user_id);
        // 発言が存在する時
        if ($chat->exists()) {
            $result = $chat->update(['data' => ['text' => '削除されたメッセージです']]);

            if (empty($result)) {
                $message = 'エラーが発生しました。';
                return self::show($room_id, config('consts.status.INTERNAL_SERVER_ERROR'), $message);
            }
        }

        // 退出システムメッセージの追加
        Chat::create([
            'section_id' => $section_id,
            'type' => 'system',
            'data' => ['text' => $this->user->username . 'が退出しました']
        ]);


        // 着席していた座席を離席状態に変更
        $this->user->seat->fill(['status' => null])->save();

        // ユーザーと座席を紐付け
        $this->user->seat()->associate($seat);
        $this->user->save();

        // 座席状態の更新
        $seat->fill(['status' => 'sitting', 'reservation_user_id' => null])->save();

        // 更新後の部屋データ
        return self::show($room_id);
    }
}
