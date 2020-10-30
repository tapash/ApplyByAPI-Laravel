<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'name' => ['required', 'string', 'min:2', 'max:50'],
            'company_name' => ['required', 'string', 'min:2', 'max:50'],
            'company_logo' => ['nullable', 'string', 'image', 'mimes:jpeg,bmp,png,gif'],
            'company_website' => ['nullable', 'min:2', 'max:255'],
            'company_description' => ['nullable', 'string', 'min:10', 'max:1000'],
            'company_address' => ['nullable', 'string', 'min:2', 'max:100'],
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
            'email' => $data['email'],
            'password' => $data['password'],
            'name' => $data['name'],
            'company_name' => $data['company_name'],
            'company_logo' => $data['company_logo'],
            'company_website' => $data['company_website'],
            'company_description' => $data['company_description'],
            'company_address' => $data['company_address'],
        ]);
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

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return new Response('', 201);
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        return response()->json([
            'success' => true,
            'message' => 'Registration successfully completed.'
        ], 201);
    }
}
