<?php

namespace Tests\Feature;

use App\Models\Region;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegionTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        Region::factory()->create();
    }

    public function test_index_regions()
    {
        $response = $this->get('/api/v1/regions');
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
