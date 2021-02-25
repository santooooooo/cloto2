<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class FollowerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->auth_user = Auth::user();
            return $next($request);
        });
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * フォロー/フォロー解除
     *
     * @param  \App\Models\User $user フォロー（解除）するユーザー
     * @return \Illuminate\Http\Response
     */
    public function follow(User $user)
    {
        if ($this->auth_user->id == $user->id) {
            return response()->json(['message' => '自分はフォローできません。'], config('consts.status.INTERNAL_SERVER_ERROR'));
        }

        // フォロー（解除）処理
        $this->auth_user->follows()->toggle($user->id);

        return $this->follow_check($user);
    }

    /**
     * フォローしている/されているか確認
     *
     * @param  \App\Models\User $user 確認するユーザー
     * @return \Illuminate\Http\Response
     */
    public function follow_check(User $user)
    {
        return response()->json([
            'following' => $this->auth_user->isFollowing($user->id),
            'followed' => $this->auth_user->isFollowed($user->id)
        ]);
    }
}
