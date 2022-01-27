<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required', 'max:255', 'min:3'],
            'national_id' => ['required', Rule::unique('users', 'national_id')],
            'email' => ['required', 'email', 'max:255', 'min:3', Rule::unique('users', 'email')],
            'password' => ['required', 'max:16', 'min:6'],
            'address' => ['required'],
            'phone_number' => ['required'],
            'picture' => ['required']
        ]);

        $attributes['picture'] = 'https://images.unsplash.com/photo-1608493573324-b055427a503e?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=627&q=80';
        $attributes['is_admin'] = false;

        User::create($attributes);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $attributes = $request->validate([
            'name' => ['required', 'max:255', 'min:3'],
            'national_id' => ['required', Rule::unique('users', 'national_id')->ignore($user->id)],
            'email' => ['required', 'email', 'max:255', 'min:3', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => ['required', 'max:16', 'min:6'],
            'address' => ['required'],
            'phone_number' => ['required'],
            'picture' => ['required']
        ]);

        $attributes['picture'] = 'https://images.unsplash.com/photo-1608493573324-b055427a503e?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=627&q=80';
        $attributes['is_admin'] = false;

        $user->update($attributes);

        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response(null, 204);
    }
}
