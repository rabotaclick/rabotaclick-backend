<?php

namespace Tests\Feature;

use App\Models\Specialization;
use App\Models\Subspecialization;
use Database\Seeders\DatabaseSeeder;
use Database\Seeders\Important\SpecializationsSeeder;
use Database\Seeders\Important\VacancyCategoriesSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\States\SeedDatabaseState;
use Tests\TestCase;
use Tests\Traits\SeedDatabaseTrait;

class SpecializationTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        Specialization::factory()->create();
        Subspecialization::factory()->create();
    }

    public function test_index()
    {
        $response = $this->get('/api/v1/specializations?first=15');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "data" => [
                [
                    "title",
                    "vacancies"
                ]
            ]
        ]);
    }

    public function test_subspecializations_index()
    {
        $response = $this->get('/api/v1/subspecializations');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "data" => [
                [
                    "title",
                    "id"
                ]
            ]
        ]);
    }
}
