<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Socialite;


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
    protected $redirectTo = '/home';

    protected function redirectTo()
    {
        if (auth()->user()->isAdminOrAbove || auth()->user()->is_company) {
            return '/backend';
        }
        return '/home';
    }


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
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $element = Socialite::driver('google')->user();
        if (!$element) {
            return redirect()->route('frontend.home')->with('error', trans('message.success'));
        }
        $user = User::where(['email' => $element->email])->first();
        if (!$user) {
            $user = User::create([
                'name' => $element->name,
                'slug_ar' => $element->name,
                'slug_en' => $element->name,
                'api_token' => $element->token,
                'password' => Hash::make('secret'),
                'email' => $element->email,
                'country_id' => Country::where('is_local', true)->first()->id,
                'role_id' => Role::where(['is_client' => true])->first()->id
            ]);
        }
        if ($user) {
            auth()->loginUsingId($user->id);
            return redirect()->route('frontend.home')->with('success', trans('message.success'));
        }
        return redirect()->route('frontend.home')->with('error', trans('message.failure'));
    }
}
