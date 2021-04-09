<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Models\Inquiry;
use App\Events\InquiryPosted;

class InquiryController extends Controller
{
    /** @var Inquiry */
    protected $inquiry;
    /** @var User */
    protected $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Inquiry $inquiry, User $user)
    {
        $this->inquiry = $inquiry;
        $this->user = $user;
    }


    /**
     * ユーザー一覧を取得
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = [];

        // 問い合わせを新しい順で取得
        $inquiry_groups = $this->inquiry->all()->sortByDesc('created_at')->groupBy('user_id');
        // 問い合わせのあるユーザーを追加
        foreach ($inquiry_groups as $inquiries) {
            $inquiry = $inquiries->first();
            $user = $inquiry->user;
            $user['replied'] = $inquiry->author == 'support' ? true : false;
            $user['last_date'] = (new Carbon($inquiry->created_at))->format('Y年m月d日 H時i分');
            array_push($users, $user);
        }

        // 問い合わせ未投稿のユーザーを追加
        foreach ($this->user->all() as $user) {
            if (count($user->inquiries) == 0) {
                $user['replied'] = true;
                array_push($users, $user);
            }
        }

        return response()->json($users);
    }

    /**
     * 問い合わせ一覧を取得
     *
     * @param  \App\Models\User  $user  問い合わせを表示するユーザー
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $inquiries = [];
        foreach ($user->inquiries as $inquiry) {
            $inquiry->data += ['meta' => (new Carbon($inquiry->created_at))->format('H時i分')];

            array_push($inquiries, [
                'author' => $inquiry->author,
                'type' => $inquiry->type,
                'data' => $inquiry->data
            ]);
        }

        return response()->json($inquiries);
    }

    /**
     * 問い合わせの投稿
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        if (!empty($data['user_id'])) {
            // 個別送信
            $result = $this->inquiry->create($data);

            if (empty($result)) {
                return response()->json(['message' => 'お問い合わせの送信に失敗しました。'], config('consts.status.INTERNAL_SERVER_ERROR'));
            }

            // 投稿したデータを送信
            broadcast(new InquiryPosted($result->user, $result));

            return response()->json();
        } else {
            // 全体一斉送信
            foreach ($this->user->all() as $user) {
                $data['user_id'] = $user->id;
                $result = $this->inquiry->create($data);

                if (empty($result)) {
                    return response()->json(['message' => 'お問い合わせの送信に失敗しました。'], config('consts.status.INTERNAL_SERVER_ERROR'));
                }

                // 投稿したデータを送信
                broadcast(new InquiryPosted($result->user, $result));
            }

            return response()->json(['message' => 'お問い合わせを一斉送信しました。']);
        }
    }
}
