<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewsletterMail;
use App\Models\User;
use Exception;

class NewsletterController extends Controller
{
    /**
     * Send newsletter mails.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function send(Request $request)
    {
        foreach (User::all() as $user) {
            try {
                if ($user->newsletter) {
                    Mail::send(new NewsletterMail([
                        'to' => $user->email,
                        'to_name' => $user->username,
                        'from' => config('mail.newsletter.address'),
                        'from_name' => config('mail.newsletter.name'),
                        'subject' => $request->subject,
                        'body' => $request->body
                    ]));
                }
            } catch (Exception $e) {
                // メール送信時のエラーを無視，処理を続行する
                continue;
            }
        }

        return response()->json(['message' => 'ニュースレターを送信しました。']);
    }
}
