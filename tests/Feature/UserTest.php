<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    private string $token;
    public function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create();
        $this->token = $user->createToken('auth-token')->plainTextToken;
    }

    public function test_get_me()
    {
        $response = $this->get('/api/v1/user/me', ['Authorization' => 'Bearer ' . $this->token]);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "data" => [
                "name",
                "surname",
                "has_password"
            ]
        ]);
    }

    public function test_update_me()
    {
        $response = $this->put('/api/v1/user/', [
            "name" => "newName",
            "surname" => "newSurname",
            "lastname" => "newLastname",
            "status" => "active",
            "password" => "newPassword",
            "change_email" => "wotacc0809@gmail.com",
            "change_phone" => "+79243609722"
        ], ['Authorization' => 'Bearer ' . $this->token]);
        $response->assertStatus(200);
        $response->assertJson([
            "data" => [
                "name" => "newName",
                "surname" => "newSurname",
                "lastname" => "newLastname",
                "status" => "active",
                "change_email" => "wotacc0809@gmail.com",
                "change_phone" => "+79243609722"
            ]
        ]);
    }

    public function test_update_phone()
    {
        $this->test_update_me();
        $response = $this->put('/api/v1/user/phone', [
            "code" => 1111
        ], ['Authorization' => 'Bearer ' . $this->token]);
        $response->assertStatus(200);
        $response->assertJson([
            "data" => [
                "phone" => "+79243609722"
            ]
        ]);
    }

    public function test_delete()
    {
        $response = $this->delete('/api/v1/user', [], ['Authorization' => 'Bearer ' . $this->token]);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "deleted_at"
        ]);
    }
}
