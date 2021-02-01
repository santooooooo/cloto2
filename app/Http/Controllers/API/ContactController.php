<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use Exception;

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
        try {
            Mail::send(new ContactMail([
                'to' => $request->email,
                'to_name' => $request->name,
                'from' => config('mail.service.contact'),
                'from_name' => config('app.name'),
                'subject' => '【お問い合わせ受付完了】- ' . config('app.name'),
                'body' => $request->body
            ], 'user'));

            Mail::send(new ContactMail([
                'to' => config('mail.service.contact'),
                'to_name' => config('app.name'),
                'from' => $request->email,
                'from_name' => $request->name,
                'subject' => 'お問い合わせ',
                'body' => $request->body
            ], 'system'));
        } catch (Exception $e) {
            return response()->json(['message' => 'エラーが発生しました。'], config('consts.status.INTERNAL_SERVER_ERROR'));
        }

        return response()->json(['message' => 'お問い合わせを送信しました。']);
    }
}
