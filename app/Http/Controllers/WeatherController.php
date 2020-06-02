<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\ValidateWeatherInput;

class WeatherController extends Controller
{

    public function getWeather(ValidateWeatherInput $request){
        
        //Validation
        $validatedData = $request->validated();

        dd($validatedData);

        //Make request to api
        $apiCall = Http::get("api.openweathermap.org/data/2.5/weather?q=" . $validatedData['city'] . "&appid=" . $validatedData['token'] . "\"");

        //Decode json to be able to use it with php
        $responseData = json_decode($apiCall);

        //Choose response
        if($responseData->cod == '401'){
            return response()->json(['code' => $responseData->cod, 'message' => 'Invalid API key'], $responseData->cod);
        } else if($responseData->cod != '200') {
            return response()->json(['code' => $responseData->cod, 'message' => $responseData->message], $responseData->cod);
        } 

        return response()->json(['code' => $responseData->cod, 'data' => $responseData], 200);
    
    }
}
