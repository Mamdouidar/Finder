<?php

namespace App\Http\Controllers;

use App\Models\FamilyMember;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FamilyMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(FamilyMember::all());
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
            'relation' => ['required'],
            'name' => ['required'],
            'national_id' => ['required', Rule::unique('family_members', 'national_id')],
            'age' => ['required'],
            'gender' => ['required']
        ]);

        $attributes['picture'] = 'https://images.unsplash.com/photo-1592479950461-2c8ef29f2a14?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=735&q=80';
        $attributes['user_id'] = 7;

        FamilyMember::create($attributes);

        return "successful";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(FamilyMember $familymember)
    {
        return response()->json($familymember);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FamilyMember $familymember)
    {
        $attributes = $request->validate([
            'relation' => ['required'],
            'name' => ['required'],
            'national_id' => ['required', Rule::unique('family_members', 'national_id')->ignore($familymember->id)],
            'age' => ['required'],
            'gender' => ['required']
        ]);

        $attributes['picture'] = 'https://images.unsplash.com/photo-1592479950461-2c8ef29f2a14?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=735&q=80';
        $attributes['user_id'] = 7;

        $familymember->update($attributes);

        return response()->json($familymember);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(FamilyMember $familymember)
    {
        $familymember->delete();
        return response(null, 204);
    }
}
