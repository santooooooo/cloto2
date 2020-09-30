<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PreRegister;

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
        Mail::send(new PreRegister([
            'to' => $request->email,
            'to_name' => $request->name,
            'from' => env('MAIL_PREREGISTER'),
            'from_name' => 'CLOTO',
            'subject' => '【仮登録受付完了】- CLOTO',
            'body' => '仮登録の受付を完了しました。リリースまでもうしばらくお待ちください。'
        ], 'user'));

        Mail::send(new PreRegister([
            'to' => env('MAIL_PREREGISTER'),
            'to_name' => 'CLOTO',
            'from' => $request->email,
            'from_name' => $request->name,
            'subject' => '仮登録申請の通知',
        ], 'system'));

        return response()->json();
    }
}
