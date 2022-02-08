<?php

namespace App\Http\Controllers;

use App\Models\UnreportedIncident;
use Illuminate\Http\Request;

class UnreportedIncidentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(UnreportedIncident::all());
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
            'area' => ['required'],
            'gender' => ['required'],
            'police_station' => ['required'],
            'picture' => ['required', 'image']
        ]);

        $attributes['user_id'] = 3;

        $file = $request->file('picture');
        $name = '/pictures/' . uniqid() . '.' . $file->extension();
        $file->storePubliclyAs('public', $name);
        $attributes['picture'] = $name;

        UnreportedIncident::create($attributes);

        return "successful";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(UnreportedIncident $unreportedincident)
    {
        return response()->json($unreportedincident);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UnreportedIncident $unreportedincident)
    {
        $attributes = $request->validate([
            'area' => ['required'],
            'gender' => ['required'],
            'police_station' => ['required'],
            'picture' => ['required', 'image']
        ]);

        $attributes['user_id'] = 3;

        $file = $request->file('picture');
        $name = '/pictures/' . uniqid() . '.' . $file->extension();
        $file->storePubliclyAs('public', $name);
        $attributes['picture'] = $name;

        $unreportedincident->update($attributes);

        return response()->json($unreportedincident);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(UnreportedIncident $unreportedincident)
    {
        $unreportedincident->delete();
        return response(null, 204);
    }
}
