<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\Announced;

class RoomController extends Controller
{
    /** @var Room */
    protected $room;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Room $room, User $user)
    {
        $this->room = $room;
        $this->user = $user;
    }


    /**
     * 部屋の一覧を取得
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->room->all());
    }

    /**
     * 部屋の区画と座席の一覧を取得
     *
     * @param  \App\Models\Room  $room  取得する部屋
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        return response()->json($room);
    }

    /**
     * アナウンス
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function announce(Request $request)
    {
        $user = Auth::user();

        if (empty($user) || empty($user->seat)) {
            return response()->json(['message' => 'アナウンスに失敗しました．．．'], config('consts.status.INTERNAL_SERVER_ERROR'));
        }

        broadcast(new Announced($user->room['id'], $request->message));
        return response()->json();
    }


    /**
     * ユーザーの累計着席時間のランキングのデータを送信
     *
     */
    public function rank()
    {
        $data = $this->user->orderBy('sitting_time', 'desc')->limit(10)->get();
        return $data;
    }
}
