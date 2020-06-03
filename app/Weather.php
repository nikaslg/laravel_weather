<?php

namespace App;

use App\Interfaces\WeatherInterface;
use Illuminate\Support\Facades\Http;

class Weather extends WeatherInterface
{

    /**
     * @var string
     *
     */
    private $ApiUrl = 'api.openweathermap.org/data/2.5/weather';

    public function getWeather(string $city,string $token) {

        $obj = Http::get($this->ApiUrl, ['q' => $city, 'appid' => $token, 'units' => 'metric'])
            ->object();

        //Cavemane error handling
        if($obj->cod !== 200){
            return [
                'code' => $obj->cod,
                'message' => $obj->message
            ];
        }

        return [
            'code' => $obj->cod,
            'city' => $obj->name,
            'weather' => [
                'main' => $obj->weather[0]->main,
                'Description' => $obj->weather[0]->description
            ],
            'main' => [
                'temp' => $obj->main->temp,
                'feels_like' => $obj->main->feels_like,
                'temp_min' => $obj->main->temp_min,
                'temp_max' => $obj->main->temp_max,
            ]
        ];

    }

}
