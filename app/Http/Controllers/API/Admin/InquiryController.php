<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Inquiry;
use App\Models\User;

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
     * 問い合わせのあるユーザー一覧を取得
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 新しい順で取得
        $inquiry_groups = $this->inquiry->all()->sortByDesc('created_at')->groupBy('user_id');

        $users = [];
        foreach ($inquiry_groups as $inquiries) {
            // データの整形
            $inquiry = $inquiries->first();
            $user = $inquiry->user;
            $user['replyed'] = $inquiry->replyed;
            $user['last_date'] = (new Carbon($inquiry->created_at))->format('Y年m月d日 H時i分');
            array_push($users, $user);
        }

        return response()->json($users);
    }

    /**
     * 問い合わせの投稿
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function post(Request $request)
    {
        $data = $request->all();

        $result = $this->inquiry->create($data);

        if (empty($result)) {
            return response(null, config('consts.status.INTERNAL_SERVER_ERROR'));
        }

        // 回答済みにする
        $user = $this->user->find($data['user_id']);
        $user->inquiries()->update(['replyed' => 1]);

        return $this->show($user->id);
    }

    /**
     * 問い合わせ一覧を取得
     *
     * @param  int  $user_id    問い合わせを表示するユーザーID
     * @return \Illuminate\Http\Response
     */
    public function show(Int $user_id)
    {
        $user = $this->user->find($user_id);

        $inquiries = [];
        foreach ($user->inquiries as $inquiry) {
            $inquiry->data += ['meta' => (new Carbon($inquiry->created_at))->format('H時i分')];

            switch ($inquiry->author) {
                case 'user':
                    $author = 'user';
                    break;

                case 'support':
                    $author = 'me';
                    break;
            }

            array_push($inquiries, [
                'author' => $author,
                'type' => $inquiry->type,
                'data' => $inquiry->data
            ]);
        }

        return response()->json($inquiries);
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
