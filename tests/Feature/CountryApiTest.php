<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class CountryApiTest extends TestCase
{
    use RefreshDatabase;

    public function testGetYoutubeVideoEndpoint()
    {
        $countryId = 'gr';

        $response = $this->get(route('countries.get.video', ['country_id' => $countryId]));

        $response->assertStatus(200);
    }

    public function testGetWikiTextEndpoint()
    {
        $countryId = 'gb';

        $response = $this->get(route('countries.get.text', ['country_id' => $countryId]));

        $response->assertStatus(200);
    }

    public function testGetCountriesEndpoint()
    {
        $response = $this->get(route('countries.get'));

        $response->assertStatus(200);
    }

    public function testGetYoutubeVideoEndpointFailsWithInvalidCountryId()
    {
        $response = $this->get(route('countries.get.video', ['country_id' => 'invalid_id']));

        $response->assertStatus(Response::HTTP_BAD_REQUEST);
    }

    public function testGetWikiTextEndpointFailsWithInvalidCountryId()
    {
        $response = $this->get(route('countries.get.text', ['country_id' => 'invalid_id']));

        $response->assertStatus(Response::HTTP_BAD_REQUEST);
    }

}
