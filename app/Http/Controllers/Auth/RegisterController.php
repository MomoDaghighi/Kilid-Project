<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Agency;
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
    protected function redirectTo()
    {
        $user = auth()->user();
        if ($user->level == 'agency') {
            return '/agency';
        } else {
            return '/panel';
        }
    }
    
    

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
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        if ($data['level'] == 'user') {
            return Validator::make($data, [
                // 'name' => ['required', 'string', 'max:255'],
                // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'phone' => ['required', 'string', 'min:11', 'max:11', 'unique:users'],
                'password' => ['required', 'string', 'min:6', 'confirmed'],
            ]);
        } else {
            return Validator::make($data, [
                'fname' => ['required', 'string', 'max:255'],
                'lname' => ['required', 'string', 'max:255'],
                'agencyname' => ['required', 'string', 'max:255'],
                //'agencyphone' => ['required', 'string', 'max:255'],
                'agencycity' => ['required', 'string', 'max:255'],

                // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'phone' => ['required', 'string', 'min:11', 'max:11', 'unique:users'],
                'password' => ['required', 'string', 'min:6', 'confirmed'],
            ]);
        }
        
        
       
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        if ($data['level'] == 'user') {
            return User::create([
                // 'name' => $data['name'],
                // 'email' => $data['email'],
                'phone' => $data['phone'],
                'password' => Hash::make($data['password']),
            ]);
        } else {
            $user =  User::create([
                'fname' => $data['fname'],
                'lname' => $data['lname'],
                'phone' => $data['phone'],
                'level' => $data['level'],
                'password' => Hash::make($data['password']),
            ]);

            Agency::create([
                'user_id' => $user->id,
                'name' => $data['agencyname'],
                'city' => $data['agencycity'],
                'phone' => $data['agencyphone'],
            ]);

            return $user;
        }
    }
}
