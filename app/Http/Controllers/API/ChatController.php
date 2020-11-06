<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ChatController extends Controller
{
    /** @var Chat */
    protected $chat;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Chat $chat)
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            $this->user->load('seat.section');
            return $next($request);
        });

        $this->chat = $chat;
    }


    /**
     * セクションごとのチャットを取得
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        // チャットに参加しているユーザーのデータ
        $chatParticipants = [];
        foreach ($section->seats->load('user') as $seat) {
            if ($seat->user != null) {
                array_push($chatParticipants, [
                    'id' => $seat->user->id,
                    'name' => $seat->user->username,
                    'imageUrl' => config('consts.storage.icon') . $seat->user->icon
                ]);
            }
        }

        // チャットデータ
        $messageList = [];
        foreach ($section->chats as $message) {
            $message->data += ['meta' => (new Carbon($message->created_at))->format('H時i分')];

            if ($message->user_id != Auth::id()) {
                array_push($messageList, [
                    'id' => $message->id,
                    'author' => $message->user_id,
                    'type' => $message->type,
                    'data' => $message->data
                ]);
            } else {
                array_push($messageList, [
                    'id' => $message->id,
                    'author' => 'me',
                    'type' => $message->type,
                    'data' => $message->data
                ]);
            }
        }

        return response()->json(compact('chatParticipants', 'messageList'));
    }

    /**
     * チャットの投稿
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function post(Request $request)
    {
        $user_id = $this->user->id;
        $section_id = $this->user->seat->section->id;
        $type = $request['type'];
        $data = $request['data'];

        $result = $this->chat->create(compact('user_id', 'section_id', 'type', 'data'));

        if (empty($result)) {
            return response(null, config('consts.status.INTERNAL_SERVER_ERROR'));
        }

        return response()->json($result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chat $chat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chat $chat)
    {
        //
    }
}
