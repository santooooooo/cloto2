<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Models\Inquiry;

class InquiryController extends Controller
{
    /** @var Inquiry */
    protected $inquiry;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Inquiry $inquiry)
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });

        $this->inquiry = $inquiry;
    }


    /**
     * ログインユーザーの問い合わせ一覧を取得
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $inquiries = [];
        foreach ($this->user->inquiries as $inquiry) {
            $inquiry->data += ['meta' => (new Carbon($inquiry->created_at))->format('H時i分')];

            switch ($inquiry->author) {
                case 'user':
                    $author = 'me';
                    break;

                case 'support':
                    $author = 'support';
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
     * 問い合わせの投稿
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function post(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = $this->user->id;

        $result = $this->inquiry->create($data);

        if (empty($result)) {
            return response(null, config('consts.status.INTERNAL_SERVER_ERROR'));
        }

        return $this->show();
    }
}
