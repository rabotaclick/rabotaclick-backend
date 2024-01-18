<?php

namespace Tests\Feature;

use App\Models\VacancyCategory;
use Database\Seeders\DatabaseSeeder;
use Database\Seeders\Important\VacancyCategoriesSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\States\SeedDatabaseState;
use Tests\TestCase;

class VacancyCategoryTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        SeedDatabaseState::$seeders = [VacancyCategoriesSeeder::class];
        $this->seedDatabase();
    }

    public function test_index()
    {
        $response = $this->get('/api/v1/vacancy/categories?first=15');
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
