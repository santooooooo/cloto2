<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Room;

class RoomController extends Controller
{
    // 背景保存ディレクトリ
    const BACKGROUND_STORE_DIR = 'public/system/room/';
    // デフォルト背景名
    const DEFAULT_BACKGROUND_FILENAME = 'default.jpg';


    /** @var Room */
    protected $room;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Room $room)
    {
        $this->room = $room;
    }


    /**
     * 部屋データ一覧の取得
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->room->all());
    }

    /**
     * 部屋データの更新
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $room_id    更新する部屋のID
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Int $room_id)
    {
        $data = $request->all();
        // 時間割データの型変換
        $data['timetable'] = json_decode($data['timetable']);

        $edit_room = $this->room->find($room_id);

        // 背景の保存
        if (!empty($request->file('background'))) {
            // 削除処理
            if ($edit_room->background != self::DEFAULT_BACKGROUND_FILENAME) {
                // 初期背景以外の場合には登録中の背景を削除
                Storage::delete(self::BACKGROUND_STORE_DIR . $edit_room->background);
            }

            // 保存処理
            $save_filename = $request->file('background')->hashName();
            $request->file('background')->storeAs(self::BACKGROUND_STORE_DIR, $save_filename);

            $data['background'] = $save_filename;
        }


        $result = $edit_room->fill($data)->save();

        if (empty($result)) {
            return response(null, config('consts.status.INTERNAL_SERVER_ERROR'));
        }

        return response(null);
    }
}
