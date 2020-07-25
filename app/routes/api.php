<?php

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

Route::domain('{account}.' . env('APP_HOST'))->middleware('auth:api')->group(function () {

    Route::match(['get', 'post'], '/add-lead', function (Request $request) {
        return $request->user();
    });


});
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
