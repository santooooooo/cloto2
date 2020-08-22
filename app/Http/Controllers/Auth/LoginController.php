<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * ユーザー名またはメールアドレスでログイン
     *
     * @return string
     */
    public function username()
    {
        return 'login';
    }

    /**
     * ユーザー名またはメールアドレスでログイン
     *
     * @param Request $request
     * @return Login
     */
    protected function attemptLogin(Request $request)
    {
        $login_field = $request->input($this->username());
        $password = $request->input('password');

        if (filter_var($login_field, \FILTER_VALIDATE_EMAIL)) {
            $credentials = ['email' => $login_field, 'password' => $password];
        } else {
            $credentials = ['username' => $login_field, 'password' => $password];
        }

        return $this->guard()->attempt($credentials, $request->filled('remember'));
    }
}
