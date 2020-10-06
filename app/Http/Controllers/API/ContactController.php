<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    /**
     * Send a mail about contact.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function contact(Request $request)
    {
        $failures = 0;

        Mail::send(new ContactMail([
            'to' => $request->email,
            'to_name' => $request->name,
            'from' => config('mail.service.contact'),
            'from_name' => 'CLOTO',
            'subject' => '【お問い合わせ受付完了】- CLOTO',
            'body' => $request->body
        ], 'user'));
        $failures += count(Mail::failures());

        Mail::send(new ContactMail([
            'to' => config('mail.service.contact'),
            'to_name' => 'CLOTO',
            'from' => $request->email,
            'from_name' => $request->name,
            'subject' => 'お問い合わせ',
            'body' => $request->body
        ], 'system'));
        $failures += count(Mail::failures());

        if ($failures > 0) {
            return response()->json('エラーが発生しました。', 500);
        }

        return response()->json('お問い合わせを送信しました。');
    }
}
