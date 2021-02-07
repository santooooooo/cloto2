<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * イベント一覧画像の更新
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (empty($request->file('event'))) {
            return response()->json(['message' => 'イベント一覧の更新に失敗しました。'], config('consts.status.INTERNAL_SERVER_ERROR'));
        }

        Storage::delete(config('consts.storage.system') . 'event.png');
        $request->file('event')->storeAs(config('consts.storage.system'), 'event.png');

        return response()->json(['message' => 'イベント一覧が更新されました。']);
    }
}
