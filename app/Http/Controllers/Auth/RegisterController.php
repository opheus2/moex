<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\Controller;
use App\Notifications\Authentication\UserRegistered;
use App\Traits\ManageReferrals;
use App\Traits\ManageLogs;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Lunaweb\EmailVerification\Traits\VerifiesEmail;
use PragmaRX\Google2FA\Google2FA;

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

    use RegistersUsers, VerifiesEmail, ManageReferrals, ManageLogs;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * An instance of google 2fa generator
     *
     * @var Google2FA
     */
    protected $google2fa;

    /**
     * Create a new controller instance.
     *
     * @param Google2FA $google2fa
     * @return void
     */
    public function __construct(Google2FA $google2fa)
    {
        $this->middleware('auth', [
            'only' => ['resendVerificationEmail']
        ]);

        $this->middleware('guest', [
            'except' => ['verify', 'resendVerificationEmail']
        ]);

        $this->google2fa = $google2fa;
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $rules = [
            'name' => 'required|unique:users|string|regex:/^[a-zA-Z0-9_-]{3,15}$/|not_in:default',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed'
        ];

        if (config()->get('services.nocaptcha.enable')) {
            $rules = array_merge($rules, [
                'g-recaptcha-response' => 'required|captcha'
            ]);
        }

        return Validator::make($data, $rules);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $secret = $this->google2fa->generateSecretKey();

        $user = User::create([
            'name' => $data['name'],
            'password' => Hash::make($data['password']),
            'email' => $data['email'],
            'google2fa_secret' => $secret
        ]);

        $user->assignRole('user');

        /*
         * Check if the registration was through a referral
         */
        if (session()->has('referrer_id')) {
            $this->newReferral($user->id, session()->pull('referrer_id'));
        }

        /*resolve('Lunaweb\EmailVerification\EmailVerification')
            ->sendVerifyLink($user);*/

        $user->notify(new UserRegistered());

        return $user;
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        // Some Logging
        $this->curateLog($user->id, $request);

        $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }
}
