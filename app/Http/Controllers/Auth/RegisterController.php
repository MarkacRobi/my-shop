<?php

namespace App\Http\Controllers\Auth;

use App\Adress;
use App\User;
use App\Http\Controllers\Controller;
use App\Http\Middleware\isGuestOrAdmin;
use Illuminate\Support\Facades\Auth;
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
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
            $this->middleware(isGuestOrAdmin::class);
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
            'surname' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'role' => ['required', 'in:PRODAJALEC,STRANKA'],
            'city' => [$data['role'] == 'PRODAJALEC' ? 'nullable' : 'required', 'string'],
            'post_number' => [$data['role'] == 'PRODAJALEC' ? 'nullable' : 'required', 'numeric'],
            'street' => [$data['role'] == 'PRODAJALEC' ? 'nullable' : 'required', 'string'],
            'street_number' => [$data['role'] == 'PRODAJALEC' ? 'nullable' : 'required', 'numeric'],
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
        $user = User::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ]);
        if($data['role'] == 'STRANKA'){
            $adress = new Adress();
            $adress->city = $data['city'];
            $adress->post_number = $data['post_number'];
            $adress->street = $data['street'];
            $adress->street_number = $data['street_number'];
            $adress->user_id = $user->id;
            $adress->save();

//            $adress = Adress::create([
//                'city' => $data['city'],
//                'post_number' => $data['post_number'],
//                'street' => $data['street'],
//                'street_number' => $data['street_number'],
//            ]);
        }

        return $user;
    }
}
