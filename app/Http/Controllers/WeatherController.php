<?php

namespace App\Http\Controllers;

use App\Weather;
use App\Http\Requests\ValidateWeatherInput;
use Illuminate\Http\JsonResponse;

class WeatherController extends Controller
{

    public function getWeather(ValidateWeatherInput $request,Weather $weather): JsonResponse {

        $validatedData = $request->validated();

        $response = $weather->getweather($validatedData['city'], $validatedData['token']);

        return response()->json($response, $response['code']);

    }
}
