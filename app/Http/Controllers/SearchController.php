<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\UnreportedIncident;
use ProtoneMedia\LaravelCrossEloquentSearch\Search;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $result = Search::addMany([
            [Report::class, 'name'],
            [UnreportedIncident::class, 'police_station']
        ])
        ->get($request->get('term'));

        return response()->json($result);
    }
}
