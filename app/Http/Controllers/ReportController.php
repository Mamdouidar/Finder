<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReportResource;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ReportResource::collection(Report::all());
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
            'national_id' => ['required', 'numeric', 'digits:14', Rule::unique('reports', 'national_id')],
            'age' => ['required'],
            'area' => ['required'],
            'gender' => ['required'],
            'picture' => ['required', 'image'],
            'clothes_last_seen_wearing' => ['required'],
            'birthmark' => ['required']           
        ]);

        $attributes['user_id'] = Auth::user()->id;

        $file = $request->file('picture');
        $name = '/pictures/' . uniqid() . '.' . $file->extension();
        $file->storePubliclyAs('public', $name);
        $attributes['picture'] = $name;

        $report = Report::create($attributes);

        return response()->json([
            'message' => 'Report has been added',
            'status_code' =>200,
            'report' => new ReportResource($report)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        return new ReportResource($report);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        $attributes = $request->validate([
            'name' => ['required', 'max:255', 'min:3'],
            'national_id' => ['required', 'numeric', 'digits:14', Rule::unique('reports', 'national_id')->ignore($report->id)],
            'age' => ['required'],
            'area' => ['required'],
            'gender' => ['required'],
            'picture' => ['required', 'image'],
            'clothes_last_seen_wearing' => ['required'],
            'birthmark' => ['required']       
        ]);

        $attributes['user_id'] = Auth::user()->id;

        $file = $request->file('picture');
        $name = '/pictures/' . uniqid() . '.' . $file->extension();
        $file->storePubliclyAs('public', $name);
        $attributes['picture'] = $name;

        $report->update($attributes);

        return response()->json([
            'message' => 'Report has been updated',
            'status_code' =>200,
            'report' => new ReportResource($report)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        $report->delete();
        return response('Report deleted', 204);
    }
}
