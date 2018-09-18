<?php

namespace App\Http\Controllers\Auth\App;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use Password;
use Auth;

use Illuminate\Support\Facades\Crypt;
use App\Models\User;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
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
        $this->middleware('guest:web');
    }

    protected function guard()
    {
        return Auth::guard('web');
    }

    protected function broker()
    {
        return Password::broker('users');
    }

    public function showResetForm(Request $request, $token = null)
    {
        return redirect()->route('login', ['#open-reset-password-second-step'])->with(['token' => $token, 'email' => $request->email]);
    }

    protected function rules()
    {
        return [
            'token'    => 'required',
            'email'    => 'required',
            'password' => 'required|confirmed|min:' . User::DEFAULT_PASSWORD_LENGTH,
        ];
    }

    /**
     * Get the password reset credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return array_merge([
                'email' => Crypt::decryptString($request->email),
            ], $request->only(
                'password', 'password_confirmation', 'token'
        ));
    }

    protected function resetPassword($user, $password)
    {   
        $user->password = $password;
        $user->setRememberToken(Str::random(60));
        $user->save();

        event(new PasswordReset($user));

        $this->guard('web')->login($user);
    }

    /**
     * Get the response for a successful password reset.
     *
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetResponse($response)
    {
        return [
            route('user'),
        ];
    }
}
