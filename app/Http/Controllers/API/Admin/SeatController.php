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
        if (isset($data['remove_media'])) {
            if (!$data['remove_media']) {
                // テキストの保存
                if (isset($data['text'])) {
                    $data['media'] = ['type' => 'text', 'data' => $data['text']];
                }

                // ファイルの保存
                else if (!empty($request->file('file'))) {
                    // 削除処理
                    if (!empty($seat->media)) {
                        Storage::delete(config('consts.storage.media') . $seat->media['data']);
                    }

                    // 拡張子の取得
                    $file_extension = $request->file('file')->getClientOriginalExtension();
                    switch (mb_strtolower($file_extension)) {
                        case 'jpg':
                            $type = 'image';
                            break;

                        case 'jpeg':
                            $type = 'image';
                            break;

                        case 'png':
                            $type = 'image';
                            break;

                        case 'mp4':
                            $type = 'video';
                            break;

                        case 'wmv':
                            $type = 'video';
                            break;

                        case 'mov':
                            $type = 'video';
                            break;
                    }

                    // ファイル保存処理
                    $filename = $request->file('file')->hashName();
                    $request->file('file')->storeAs(config('consts.storage.media'), $filename);

                    $data['media'] = ['type' => $type, 'data' => $filename];
                }
            } else {
                // メディアの解除
                if (!empty($seat->media) && $seat->media['type'] != 'text') {
                    // ファイル削除処理
                    Storage::delete(config('consts.storage.media') . $seat->media['data']);
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
