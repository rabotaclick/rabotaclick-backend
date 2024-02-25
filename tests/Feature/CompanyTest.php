<?php

namespace Tests\Feature;

use App\Models\City;
use App\Models\Company;
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
        $response = $this->post('/api/v1/employer/company', [
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

    public function test_company_update()
    {
        $this->test_company_create();
        $response = $this->put('/api/v1/employer/company', [
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

    public function test_update_company_photo()
    {
        $this->test_company_create();
        $response = $this->put('/api/v1/employer/company/photo', [
            "url" => "https://cdn.rabotaclick.pro/photos/phpic5YTD.webp"
        ], ['Authorization' => 'Bearer ' . $this->token]);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "data" => [
                "id",
                "photo"
            ]
        ]);
    }

    public function test_get_my_company()
    {
        $this->test_company_create();
        $response = $this->get('/api/v1/employer/company/my', ['Authorization' => 'Bearer ' . $this->token]);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "data" => [
                "id",
                "photo"
            ]
        ]);
    }

    public function test_get_company()
    {
        $this->test_company_create();
        $response = $this->get('/api/v1/company/'.Company::first()->id);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "data" => [
                "id",
                "photo"
            ]
        ]);
    }
}
