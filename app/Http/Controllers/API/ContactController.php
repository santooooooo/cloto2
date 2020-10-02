<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Contact;

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
        Mail::send(new Contact([
            'to' => $request->email,
            'to_name' => $request->name,
            'from' => env('MAIL_CONTACT'),
            'from_name' => 'CLOTO',
            'subject' => '【お問い合わせ受付完了】- CLOTO',
            'body' => $request->body
        ], 'user'));

        Mail::send(new Contact([
            'to' => env('MAIL_CONTACT'),
            'to_name' => 'CLOTO',
            'from' => $request->email,
            'from_name' => $request->name,
            'subject' => 'お問い合わせ',
            'body' => $request->body
        ], 'system'));

        return response()->json();
    }
}
