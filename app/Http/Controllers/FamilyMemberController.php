<?php

namespace App\Http\Controllers;

use App\Http\Resources\FamilyMemberResource;
use App\Models\FamilyMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        $attributes['user_id'] = Auth::user()->id;

        $file = $request->file('picture');
        $name = '/pictures/' . uniqid() . '.' . $file->extension();
        $file->storePubliclyAs('public', $name);
        $attributes['picture'] = $name;

        $familymember = FamilyMember::create($attributes);

        return response()->json([
            'message' => 'Family Member has been added',
            'status_code' =>200,
            'family_member' => new FamilyMemberResource($familymember)
        ]);
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

        return response()->json([
            'message' => 'Family Member has been updated',
            'status_code' =>200,
            'family_member' => new FamilyMemberResource($familymember)
        ]);
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
        return response('Family member deleted', 204);
    }
}
