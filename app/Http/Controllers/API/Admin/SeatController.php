<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seat;

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
        $this->seat = $seat;
    }


    /**
     * 座席データの更新
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $seat_id    更新する座席のID
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Int $seat_id)
    {
        $data = $request->all();
        // 配列の中身をint化
        $data['position'] = array_map('intval', $data['position']);

        $edit_seat = $this->seat->find($seat_id);

        $result = $edit_seat->fill($data)->save();

        if (empty($result)) {
            return response(null, config('consts.status.INTERNAL_SERVER_ERROR'));
        }

        return response(null);
    }
}
