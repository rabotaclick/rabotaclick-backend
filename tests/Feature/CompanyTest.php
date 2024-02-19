<?php

namespace Tests\Feature;

use App\Models\City;
use App\Models\Specialization;
use App\Models\UserEmployer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    use RefreshDatabase;

    private string $token;

    public function setUp(): void
    {
        parent::setUp();
        City::factory()->create();
        Specialization::factory()->create();
        $this->token = UserEmployer::factory()->create()->createToken('auth-token', ['role:employer'])->plainTextToken;
    }

    public function test_company_create()
    {
        $response = $this->post('/api/v1/company', [
            'type' => 'project',
            'name' => 'test',
            'city_id' => City::first()->id,
            'website' => 'https://test.com',
            'specialization_id' => Specialization::first()->id,
            'phone' => '+79243609722',
            'description' => 'test'
        ], ['Authorization' => 'Bearer ' . $this->token]);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "data" => [
                "id",
                "name"
            ]
        ]);
    }
}
