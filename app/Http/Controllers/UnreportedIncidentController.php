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
        ]);

        $attributes['picture'] = 'https://images.unsplash.com/photo-1592479950461-2c8ef29f2a14?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=735&q=80';
        $attributes['user_id'] = 3;

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
        ]);

        $attributes['picture'] = 'https://images.unsplash.com/photo-1592479950461-2c8ef29f2a14?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=735&q=80';
        $attributes['user_id'] = 3;

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
