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
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            $this->user->load('seat.section');
            return $next($request);
        });
    }


    /**
     * Post a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function post(Request $request)
    {
        $user_id = $this->user->id;
        $section_id = $this->user->seat->section->id;
        $type = $request['type'];
        $data = json_encode($request['data'], JSON_UNESCAPED_UNICODE);

        // チャットの保存
        $result = $this->user->chats()->create(compact('user_id', 'section_id', 'type', 'data'));

        if (empty($result)) {
            return response(null, config('consts.status.INTERNAL_SERVER_ERROR'));
        }

        return response()->json($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        // チャットに参加しているユーザーのデータ
        $chatParticipants = [];
        foreach ($section->chats->unique('user_id')->load('user') as $user_data) {
            if ($user_data->user->id != Auth::id()) {
                array_push($chatParticipants, [
                    'id' => $user_data->user->id,
                    'name' => $user_data->user->username,
                    'imageUrl' => config('consts.storage.icon') . $user_data->user->icon
                ]);
            }
        }

        // チャットデータ
        $messageList = [];
        foreach ($section->chats as $message_data) {
            $data = json_decode($message_data->data, true);
            $data += ['meta' => (new Carbon($message_data->created_at))->format('H時i分')];

            if ($message_data->user_id != Auth::id()) {
                array_push($messageList, [
                    'id' => $message_data->id,
                    'author' => $message_data->user_id,
                    'type' => $message_data->type,
                    'data' => $data
                ]);
            } else {
                array_push($messageList, [
                    'id' => $message_data->id,
                    'author' => 'me',
                    'type' => $message_data->type,
                    'data' => $data
                ]);
            }
        }

        return response()->json(compact('chatParticipants', 'messageList'));
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
