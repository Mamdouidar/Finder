<?php

namespace App\Http\Controllers;

use App\Http\Resources\UnreportedIncidentResource;
use App\Models\UnreportedIncident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UnreportedIncidentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return UnreportedIncidentResource::collection(UnreportedIncident::all());
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

        $unreportedincident = UnreportedIncident::create($attributes);

        return response()->json([
            'message' => 'Incident has been created',
            'status_code' =>200,
            'unreported_incident' => new UnreportedIncidentResource($unreportedincident)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(UnreportedIncident $unreportedincident)
    {
        return new UnreportedIncidentResource($unreportedincident);
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

        $attributes['user_id'] = Auth::user()->id;

        $file = $request->file('picture');
        $name = '/pictures/' . uniqid() . '.' . $file->extension();
        $file->storePubliclyAs('public', $name);
        $attributes['picture'] = $name;

        $unreportedincident->update($attributes);

        return response()->json([
            'message' => 'Incident has been updated',
            'status_code' =>200,
            'unreported_incident' => new UnreportedIncidentResource($unreportedincident)
        ]);
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
        return response('Incident Deleted', 204);
    }
}
