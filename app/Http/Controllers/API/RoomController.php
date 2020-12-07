<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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
     * 部屋の区画と座席の一覧を取得
     *
     * @param  Int  $room_id  部屋ID
     * @return \Illuminate\Http\Response
     */
    public function show(Int $room_id)
    {
        return response()->json($this->room->find($room_id));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->room->with('sections.seats')->get());
    }
}
