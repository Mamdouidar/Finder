<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FamilyMemberController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UnreportedIncidentController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::apiResource('/reports', ReportController::class)->only(['index', 'show']);
Route::apiResource('/unreportedincidents', UnreportedIncidentController::class)->only(['index', 'show']);

Route::get('/search', [SearchController::class, 'search']);


Route::group(['middleware' => 'auth:sanctum'], function(){
    Route::apiResource('/users', UserController::class)->except('store');
    Route::apiResource('/reports', ReportController::class)->except(['index', 'show']);
    Route::apiResource('/unreportedincidents', UnreportedIncidentController::class)->except(['index', 'show']);
    Route::apiResource('/familymembers', FamilyMemberController::class);
    Route::post('/logout', [AuthController::class, 'logout']);    
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
