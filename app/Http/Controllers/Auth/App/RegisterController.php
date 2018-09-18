<?php

namespace App\Http\Controllers\Auth\App;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

use App\Models\User;
use App\Models\UserSocial;
use App\Http\Requests\App\Auth\RegisterRequest;
use App\Http\Requests\App\Auth\SocialRegisterRequest;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:web');
    }

    public function register()
    {
        return view('auth_app.register');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(RegisterRequest $request, User $user)
    {
        $user->fill($request->all());
        $user->password   = $request->password;
        $user->mail_token = $request->email;
        $user->save();

        return redirect()->route('home', ['#open-confirm-email']);
    }

    public function registerFromSocial()
    {
        return view('auth_app.register_social', [
            'firstName' => session('firstName'),
            'lastName'  => session('lastName'),
            'email'     => session('email'),
        ]);
    }

    protected function createFromSocial(SocialRegisterRequest $request, User $user)
    {
        $userByPhone = User::where('phone', $request->phone)->first();
        $userByEmail = User::where('email', $request->email)->first();

        if ((isset($userByPhone) && ! isset($userByEmail)) ||
            (! isset($userByPhone) && isset($userByEmail)) ||
            (isset($userByPhone) && isset($userByEmail) && $userByPhone->id !== $userByEmail->id)) {
            return redirect()->route('register.social')->withErrors([
                'phone' => 'lol',
                'email' => 'kek',
            ])->withInput();
        } 

        if (! isset($userByPhone) && ! isset($userByEmail)) {
            $user->fill($request->all());
            $user->password          = User::generatePassword();
            $user->is_mail_confirmed = true;
            $user->save();
        } else {
            $user = $userByEmail;
        }

        $social = session('social');
        if (isset($social)) {
            $user->setAvatarFromUrl($social['avatarUrl']);

            $user->saveSocial($social['provider'], $social['socialId']);
        }

        auth()->guard('web')->login($user);

        return redirect()->route('user');
    }

    public function confirm($token)
    {
        $user = User::where('mail_token', $token)->first();
        $user->is_mail_confirmed = true;
        $user->save();

        auth()->guard('web')->login($user);

        return redirect()->route('user');
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider(Request $request)
    {
        return Socialite::driver($request->provider)
                // ->scopes(['email'/*,'publish_actions'*/])
                ->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback(Request $request)
    {
        $loginException = false;

        try {
            $user      = Socialite::driver($request->provider)->user();

            $userName  = explode(' ', $user->getName());
            $userData  = [
                'provider'   => $request->provider,
                'socialId'   => $user->getId(),
                'first_name' => $userName[0],
                'last_name'  => $userName[1],
                'email'      => $user->getEmail(),
                'avatarUrl'  => $user->getAvatar(),
            ];
        } catch (\Exception $e) {
            $loginException = true;
        }

        if ($loginException) {
            return redirect()->route('home', ['#open-auth-social-error']);
        }

        $redirect = $this->getRedirectAttributes($userData);

        if (isset($redirect['user'])) {
            auth()->guard('web')->login($redirect['user']);
        }

        if (isset($redirect['social'])) {
            session(['social' => $redirect['social']]);
        }

        return redirect($redirect['url'])->with($redirect['params']);
    }

    private function getRedirectAttributes($userData)
    {
        $siteUser = $this->findUser($userData);

        if (isset($siteUser)) {
            $url    = route('user');
        } else {
            $url    = route('register.social');
            $params = [
                'firstName' => $userData['first_name'],
                'lastName'  => $userData['last_name'],
                'email'     => $userData['email'],
            ];
            $social = [
                'provider'  => $userData['provider'],
                'socialId'  => $userData['socialId'],
                'avatarUrl' => $userData['avatarUrl'],
            ];
        }

        return [
            'user'   => $siteUser,
            'url'    => $url,
            'params' => $params ?? [],
            'social' => $social ?? null
        ]; 
    }

    private function findUser($userData)
    {
        if (! empty($userData['email'])) {
            $siteUser = User::where('email', $userData['email'])->first();

            $siteUser->saveSocial($userData['provider'], $userData['socialId']);
        } else {
            $siteUser = User::whereHas('socials', function ($query) use ($userData) {
                            $query->where([
                                'social_type' => $userData['provider'],
                                'social_id'   => $userData['socialId'],
                            ]);
                        })->first();
        }

        return $siteUser;
    }
}
