<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
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
    protected $redirectTo = '/';
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
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            "password" => ["required", "min:8", "regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9]).*$/", "confirmed"],
            'avatar' => ['nullable'],
        ], [
            'name.required' => 'Please enter your name',
            'email.required' => 'Please enter your email',
            'avatar.required' => 'Please enter your image',
            'password.required' => 'Password field is required',
            'password.confirmed' => 'Password confirmation does not match.',
            'password.min' => 'Password must be of at least 8 characters.',
            'password.regex' => 'Password must contain a number and a letter',
        ]);

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */

    private function create(array $data)
    {

        $image = "";
        if (request()->hasFile('avatar')) {
            $image = request()->file('avatar')->getClientOriginalName();
            request()->file('avatar')->move(public_path('avatars'), $image);
        }

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'avatar' => $image,
            'password' => Hash::make($data['password']),
            'status' => 1,
            'type' => 'user',
        ]);
    }

}
