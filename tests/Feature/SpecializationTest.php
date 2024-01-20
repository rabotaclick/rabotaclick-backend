<?php

namespace Tests\Feature;

use App\Models\Specialization;
use Database\Seeders\DatabaseSeeder;
use Database\Seeders\Important\SpecializationsSeeder;
use Database\Seeders\Important\VacancyCategoriesSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\States\SeedDatabaseState;
use Tests\TestCase;

class SpecializationTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        SeedDatabaseState::$seeders = [SpecializationsSeeder::class];
        $this->seedDatabase();
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
}
