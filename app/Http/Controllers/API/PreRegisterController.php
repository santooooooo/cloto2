<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PreRegisterMail;

class PreRegisterController extends Controller
{
    /**
     * Send a mail about who pre register.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function pre_register(Request $request)
    {
        $failures = 0;

        Mail::send(new PreRegisterMail([
            'to' => $request->email,
            'to_name' => $request->name,
            'from' => config('mail.service.preregister'),
            'from_name' => 'CLOTO',
            'subject' => '【仮登録受付完了】- CLOTO',
            'newsletter' => $request->newsletter
        ], 'user'));
        $failures += count(Mail::failures());

        Mail::send(new PreRegisterMail([
            'to' => config('mail.service.preregister'),
            'to_name' => 'CLOTO',
            'from' => $request->email,
            'from_name' => $request->name,
            'subject' => '仮登録申請の通知',
            'newsletter' => $request->newsletter
        ], 'system'));
        $failures += count(Mail::failures());

        if ($failures > 0) {
            return response()->json('エラーが発生しました。', config('consts.status.INTERNAL_SERVER_ERROR'));
        }

        return response()->json('仮登録の受付を完了しました。');
    }
}
