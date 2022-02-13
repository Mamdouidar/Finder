<?php

namespace App\Http\Controllers;

use App\Http\Resources\FamilyMemberResource;
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
        return FamilyMemberResource::collection(FamilyMember::all());
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
            'national_id' => ['required', 'numeric', 'digits:14', Rule::unique('family_members', 'national_id')],
            'age' => ['required'],
            'gender' => ['required'],
            'picture' => ['required', 'image']
        ]);

        $attributes['user_id'] = 7;

        $file = $request->file('picture');
        $name = '/pictures/' . uniqid() . '.' . $file->extension();
        $file->storePubliclyAs('public', $name);
        $attributes['picture'] = $name;

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
        return new FamilyMemberResource($familymember);
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
            'national_id' => ['required', 'numeric', 'digits:14', Rule::unique('family_members', 'national_id')->ignore($familymember->id)],
            'age' => ['required'],
            'gender' => ['required'],
            'picture' => ['required', 'image']
        ]);

        $attributes['user_id'] = 7;

        $file = $request->file('picture');
        $name = '/pictures/' . uniqid() . '.' . $file->extension();
        $file->storePubliclyAs('public', $name);
        $attributes['picture'] = $name;

        $familymember->update($attributes);

        return new FamilyMemberResource($familymember);
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
