<?php

namespace App\Http\Controllers\Auth\App;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Models\User;

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
    protected $redirectTo = '/user';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:web')->only(['login', 'loginPost']);
        $this->middleware('auth:web')->only(['logout']);
    }

    public function login()
    {
        return view('auth_app.login');
    }

    public function loginPost(Request $request)
    {
        $this->validate($request, [
            'phone'    => 'required',
            'password' => 'required',
        ]);

        if (Auth::guard('web')->attempt(['phone' => $request->phone, 'password' => $request->password, 'role' => User::ROLE_USER, 'is_mail_confirmed' => true])) {
            return redirect()->intended(route('user'));
        } 

        return redirect()->back()->withInput($request->only('email', 'is_remember'))->withErrors([
            'password' => __('app.login.error'),
        ]);
    }

    public function logout()
    {
        auth()->guard('web')->logout();

        return redirect()->route('home');
    }
}
