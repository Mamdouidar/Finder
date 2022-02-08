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
            'picture' => ['required', 'image']
        ]);

        $attributes['is_admin'] = false;

        $file = $request->file('picture');
        $name = '/pictures/' . uniqid() . '.' . $file->extension();
        $file->storePubliclyAs('public', $name);
        $attributes['picture'] = $name;

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
