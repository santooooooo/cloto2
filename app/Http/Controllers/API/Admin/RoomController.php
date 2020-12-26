<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * 部屋データの更新
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $room_id    更新する部屋のID
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $room_id)
    {
        $data = $request->all();
        // 時間割データの型変換
        $data['timetable'] = json_decode($data['timetable']);

        $edit_room = $this->room->find($room_id);

        $result = $edit_room->fill($data)->save();

        if (empty($result)) {
            return response(null, config('consts.status.INTERNAL_SERVER_ERROR'));
        }

        return response(null);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
