<?php

namespace App\Http\Controllers\Auth;

use App\Events\PostSuccessfullAuth;
use App\Http\Controllers\Controller;
use App\User;
use App\City;
use App\Token;
use Event;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Validator;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    private $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }


    public function getRegister($token)
    {
        return view('auth.register', compact('token'));
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name_first' => 'required|max:255',
            'name_last'  => 'required|max:255',
            'username'   => 'required|max:255',
            'bio'        => 'required|max:255',
            'email'      => 'required|email|max:255|unique:users',
            'password'   => 'required|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     *
     * @return User
     */
    protected function create(array $data)
    {
        $token = Token::where('token','=',$data['registration_token'])->first();
        $city = City::where('id', '=', $token->city_id)->first();

        $user = User::create([
            'name_first' => $data['name_first'],
            'name_last'  => $data['name_last'],
            'username'   => $data['username'],
            'bio'        => $data['bio'],
            'email'      => $data['email'],
            'password'   => bcrypt($data['password']),
            'city_id'    => $city->id
        ]);

        Event::fire(new PostSuccessfullAuth($data['registration_token']));

        return $user;
    }
}
