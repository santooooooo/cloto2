<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\BroadcastMail;
use Exception;

class BroadcastController extends Controller
{
    /**
     * Send a mail about broadcast.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function broadcast(Request $request)
    {
        try {
            Mail::send(new BroadcastMail([
                'to' => $request->email,
                'to_name' => $request->name,
                'from' => config('mail.service.contact'),
                'from_name' => config('app.name'),
                'subject' => '【お問い合わせ受付完了】- ' . config('app.name'),
                'body' => $request->body
            ], 'user'));
        } catch (Exception $e) {
            return response()->json(['message' => 'エラーが発生しました。'], config('consts.status.INTERNAL_SERVER_ERROR'));
        }

        return response()->json(['message' => 'お問い合わせを送信しました。']);
    }
}
