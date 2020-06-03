<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WeatherTest extends TestCase
{

    const GETWEATHERURL = '/api/getweather';

    /**
     *
     * @return void
     */
    public function testApiWithoutParams()
    {
        $response = $this->json('GET', self::GETWEATHERURL);

        $response
            ->assertStatus(422)
            ->assertJsonStructure([
                'message',
                'errors'
            ]);

    }


    /**
     *
     * @return void
     */
    public function testCorrectApiCall()
    {
        $response = $this->json( 'GET', self::GETWEATHERURL, ['city' => 'Vilnius', 'token' => 'eefbba8fd82b69509fc1f1785da6ca91']);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                    'weather',
                    'main',
            ]);
    }

    /**
     *
     * @return void
     */
    public function testApiCallWithWrongParams()
    {
        $response = $this->json( 'GET', self::GETWEATHERURL, ['city' => 'WrongCity', 'token' => 'eefbba8fd82b69509fc1f1785da6ca91']);

        $response
            ->assertStatus(404)
            ->assertJsonStructure([
                    'message'
            ])->assertJsonFragment(['message' => 'city not found']);
    }


}
