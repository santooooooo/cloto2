<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * 部屋の区画と座席の一覧を取得
     *
     * @param  Int  $id  部屋ID
     * @param  Int  $status  ステータスコード
     * @param  String  $message  メッセージ
     * @return \Illuminate\Http\Response
     */
    static function show(Int $id, Int $status = 200, String $message = '')
    {
        return response()->json(
            [
                'roomData' => Room::with('sections.seats.user')->find($id),
                'message' => $message
            ],
            $status
        );
    }
}
