<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
     * @param  \App\Models\Seat $seat   更新する座席
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seat $seat)
    {
        $data = $request->all();

        // 配列の中身をint化
        if (!empty($data['position'])) {
            $data['position'] = array_map('intval', $data['position']);
        }

        // メディアの更新
        if (isset($data['media'])) {
            // 動画の保存
            if (!empty($request->file('media')) && !$data['remove_media']) {
                // 削除処理
                if (!empty($seat->media)) {
                    Storage::delete(config('consts.storage.media') . $seat->media);
                }

                // 保存処理
                $filename = $request->file('media')->hashName();
                $request->file('media')->storeAs(config('consts.storage.media'), $filename);

                $data['media'] = $filename;
            }

            // 動画の削除
            if ($data['remove_media']) {
                // 削除処理
                if (!empty($seat->media)) {
                    Storage::delete(config('consts.storage.media') . $seat->media);
                }

                $data['media'] = null;
            }
        }

        $result = $seat->fill($data)->save();

        if (empty($result)) {
            return response(null, config('consts.status.INTERNAL_SERVER_ERROR'));
        }

        return response(null);
    }
}
