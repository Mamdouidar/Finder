<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
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
        return response()->json(Report::all());
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
            'national_id' => ['required', Rule::unique('reports', 'national_id')],
            'age' => ['required'],
            'area' => ['required'],
            'gender' => ['required'],
            'clothes_last_seen_wearing',
            'birthmark'            
        ]);

        $attributes['picture'] = 'https://images.unsplash.com/photo-1592479950461-2c8ef29f2a14?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=735&q=80';
        $attributes['user_id'] = 4;

        Report::create($attributes);

        return "successful";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        return response()->json($report);
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
            'national_id' => ['required', Rule::unique('reports', 'national_id')->ignore($report->id)],
            'age' => ['required'],
            'area' => ['required'],
            'gender' => ['required'],
            'clothes_last_seen_wearing',
            'birthmark'            
        ]);

        $attributes['picture'] = 'https://images.unsplash.com/photo-1592479950461-2c8ef29f2a14?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=735&q=80';
        $attributes['user_id'] = 4;

        $report->update($attributes);

        return response()->json($report);
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
        return response(null, 204);
    }
}
