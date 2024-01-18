<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    private string $token;
    public function setUp(): void
    {
        parent::setUp();
        User::factory()->create([
            "phone" => "+79243609723",
            "email" => "test@gmail.com",
            "password" => Hash::make("password")
        ]);
    }

    public function test_get_code()
    {
        $response = $this->post('/api/v1/auth/code', [
            "phone" => "+79243609722"
        ]);
        $response->assertStatus(200);
        $response->assertJson([
            "phone" => "+79243609722"
        ]);
    }

    public function test_register_user()
    {
        $this->test_get_code();
        $response = $this->post('/api/v1/auth/', [
            "phone" => "+79243609722",
            "code" => 1111
        ]);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "token"
        ]);
        $this->token = $response->json('token');
    }

    public function test_finish_registration()
    {
        $this->test_register_user();
        $response = $this->post('/api/v1/auth/register', [
            "name" => "test",
            "surname" => "testsurname"
        ], [
            'Authorization' => 'Bearer ' . $this->token
        ]);
        $response->assertStatus(200);
        $response->assertJson([
            "data" => [
                "name" => "test",
                "surname" => "testsurname"
            ]
        ]);
    }

    public function test_login()
    {
        $this->test_finish_registration();
        $this->test_get_code();
        $response = $this->post('/api/v1/auth/', [
            "phone" => "+79243609722",
            "code" => 1111
        ], [
            'Authorization' => 'Bearer ' . $this->token
        ]);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "token"
        ]);
    }

    public function test_login_by_phone_and_password()
    {
        $response = $this->post('/api/v1/auth/password', [
            "login" => "+79243609723",
            "password" => "password"
        ]);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "token"
        ]);
    }

    public function test_login_by_email_and_password()
    {
        $response = $this->post('/api/v1/auth/password', [
            "login" => "test@gmail.com",
            "password" => "password"
        ]);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "token"
        ]);
    }
}
