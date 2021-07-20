<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\BroadcastMail;
use App\Models\User;
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
            $users = User::all();

            foreach ($users as $user) {
                if ($user->newsletter) {
                    Mail::send(new BroadcastMail([
                        'to' => $user->email,
                        'to_name' => $user->handlename,
                        'from' => config('mail.newsletter.address'),
                        'from_name' => config('mail.newsletter.name'),
                        'subject' => $request->subject,
                        'body' => $request->body
                    ]));
                }
            }
        } catch (Exception $e) {
            // メール送信時のエラーを無視，処理を続行する
        }

        return response()->json(['message' => 'ニュースレターを送信しました。']);
    }
}
