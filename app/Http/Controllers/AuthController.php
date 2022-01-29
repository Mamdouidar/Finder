<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required', 'max:255', 'min:3'],
            'national_id' => ['required', Rule::unique('users', 'national_id')],
            'email' => ['required', 'email', 'max:255', 'min:3', Rule::unique('users', 'email')],
            'password' => ['required', 'max:16', 'min:6'],
            'address' => ['required'],
            'phone_number' => ['required'],
        ]);

        $attributes['picture'] = 'https://images.unsplash.com/photo-1608493573324-b055427a503e?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=627&q=80';
        $attributes['is_admin'] = false;

        User::create($attributes);

        return "Successful";
    }

    public function login(Request $request)
    {
        $attributes = $request->validate([
            'national_id' => ['required', Rule::exists('users', 'national_id')],
            'password' => ['required']
        ]);

        if(auth()->attempt($attributes)) {
            return response('Logged in', 200);
        }

        return response('Login Failed', 403);
    }

    public function logout()
    {
        auth()->logout();
        return response('Logged out', 200);
    }
}
