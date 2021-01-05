<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    public function win_hashs($length){
        return substr(str_shuffle(str_repeat('123456789abcdefghijklmnopqrstuvwxyz',$length)),0,$length);	
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:11'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([

            'bid' => $this->win_hashs(5),
            'userid' => $this->win_hashs(8),
            'surname' => $data['surname'],
            'othername' => $data['othername'],
            'sex' => $data['sex'],
            'email' => $data['email'],
            'state' => $data['state'],
            'city' => $data['city'],
            'address' => $data['address'],
            'address2' => $data['address2'],
            'birthday' => $data['birthday'],
            'accname' => $data['accname'],
            'bank' => $data['bank'],
            'is_user' => $data['is_user'],
            'is_admin' => $data['is_admin'],
            'accountno' => $data['accountno'],
            'bvn' => $data['bvn'],
            'ctime' => time(),
            'name' => $data['name'],
            'phone' => $data['phone'],
            'phone2' => $data['phone2'],
            'password' => Hash::make($data['password']),

        ]);
    }
}
