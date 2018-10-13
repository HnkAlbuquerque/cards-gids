<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
    protected $redirectTo = 'adm/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function loginScreen()
    {
        return view('vendor.adminlte.login');
    }

    public function login(Request $request)
    {
        $func = User::where('new_as_cod','=', $request->new_as_cod)->where('as_tipo','=','F')->first();

        if(Auth::attempt(['new_as_cod' =>  $request->get('new_as_cod'), 'password' => $request->get('password'), 'bloqueado' => false]))
        {
            return redirect()->route('home');
        }

        return redirect()->route('login');

    }
}
