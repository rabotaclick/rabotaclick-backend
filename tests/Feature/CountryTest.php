<?php

namespace Tests\Feature;

use App\Models\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CountryTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        Country::factory(['name' => 'Россия'])->create();
    }

    public function test_index_countries()
    {
        $response = $this->get('/api/v1/countries');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "data" => [
                [
                    "id",
                    "name"
                ]
            ]
        ]);
    }

    public function test_index_search_countries()
    {
        $response = $this->get('/api/v1/countries?search=Рос');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "data" => [
                [
                    "id",
                    "name"
                ]
            ]
        ]);
    }
}
