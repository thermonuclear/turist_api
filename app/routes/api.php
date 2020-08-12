<?php

use App\Http\Controllers\LeadController;
use App\Http\Controllers\TouristController;
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

Route::domain('{account}.' . env('APP_HOST'))->middleware('auth:api')->group(function () {

    Route::post('/add-lead', [LeadController::class, 'index']);
    Route::post('/add-tourist', [TouristController::class, 'store']);
    Route::post('/edit-tourist', [TouristController::class, 'update']);
    Route::post('/get-tourist-list', [TouristController::class, 'show']);
    Route::post('/get-tourist-list-by-name', [TouristController::class, 'showName']);
    Route::post('/delete-tourist', [TouristController::class, 'destroy']);

});
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
