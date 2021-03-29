<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\RoomChatPosted;

class ChatController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Chat $chat)
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });

        $this->chat = $chat;
    }


    /**
     * 部屋チャット一覧を取得
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $room = $this->user->seat->section->room;
        return response()->json($room->chats->sortByDesc('created_at')->values());
    }

    /**
     * 部屋チャットの投稿
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = $this->user->id;
        $data['room_id'] = $this->user->room['id'];

        $result = $this->chat->create($data);

        if (empty($result)) {
            return response()->json(['message' => 'チャットの送信に失敗しました．．．'], config('consts.status.INTERNAL_SERVER_ERROR'));
        }

        broadcast(new RoomChatPosted($this->user, $request->body));
        return response()->json();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
