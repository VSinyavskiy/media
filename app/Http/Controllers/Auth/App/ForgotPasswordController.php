<?php

namespace App\Http\Controllers\Auth\App;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Password;

use Illuminate\Validation\Rule;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:web');
    }

    protected function broker()
    {
        return Password::broker('users');
    }

    protected function validateEmail(Request $request)
    {
        $this->validate($request, ['email' => [
            'required',
            'email',
            'max:191',
            Rule::exists('users')->where(function ($query) {
                $query->where('is_mail_confirmed', 1);
            }),
        ]]);
    }
}
