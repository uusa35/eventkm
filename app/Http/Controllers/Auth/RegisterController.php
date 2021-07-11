<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:80', 'min:3'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users','min:8'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'mobile' => 'string|max:10|min:5',
            'country_id' => ['required', 'integer', 'exists:countries,id'],
            'area_id' => ['required', 'integer', 'exists:areas,id'],
            'role_id' => ['required', 'integer', 'exists:roles,id'],
            'captcha' => 'required|captcha'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $role = Role::whereId($data['role_id'])->where(['is_super' => false , 'is_admin' => false,'is_client' => true ])->first();
        return User::create([
            'name' => $data['name'],
            'slug_ar' => $data['name'],
            'slug_en' => $data['name'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'password' => Hash::make($data['password']),
            'country_id' => $data['country_id'],
            'area_id' => $data['area_id'],
            'role_id' => $data['role_id'] ? $data['role_id'] : $role->id,
            'api_token' => rand(9999999, 99999999999).str_random(5),
        ]);
    }

    public function messages()
    {
        return [
            'validation.captcha' => 'Captcha is not correct.',
        ];
    }
}
