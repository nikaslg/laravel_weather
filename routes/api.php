<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

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

Route::get('getweather/', function(Request $request){

    return Http::get("api.openweathermap.org/data/2.5/weather?q=vilnius&appid=eefbba8fd82b69509fc1f1785da6ca91");
});