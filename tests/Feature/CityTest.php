<?php

namespace Tests\Feature;

use App\Models\City;
use Database\Seeders\Important\SpecializationsSeeder;
use Database\Seeders\Important\SubjectsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\States\SeedDatabaseState;
use Tests\TestCase;
use Tests\Traits\SeedDatabaseTrait;

class CityTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        City::factory()->count(4)->create();
        City::factory(['name' => 'Якутск'])->count(1)->create();
    }

    public function test_get_cities()
    {
        $response = $this->get('/api/v1/cities?first=15');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "data" => [
                [
                    "name",
                    "region" => [
                        "country" => [
                            "name"
                        ]
                    ]
                ]
            ]
        ]);
    }

    public function test_get_cities_with_search()
    {
        $response = $this->get('/api/v1/cities?first=15&search=Якутск');
        $response->assertStatus(200);
        $response->assertJson([
            "data" => [
                [
                    "name" => "Якутск",
                ]
            ]
        ]);
    }
    public function test_get_cities_with_letter()
    {
        $response = $this->get('/api/v1/cities?first=15&letter=Я');
        $response->assertStatus(200);
        $response->assertJson([
            "data" => [
                [
                    "name" => 'Якутск',
                ]
            ]
        ]);
    }
}
