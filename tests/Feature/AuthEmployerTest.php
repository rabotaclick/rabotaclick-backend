<?php

namespace Tests\Feature;

use App\Models\UserEmployer;
use App\Models\UserEmployerRegister;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthEmployerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_register()
    {
        $response = $this->post('/api/v1/auth/employer/register', [
            "email" => "wotacc0809@gmail.com",
            "password" => "testtest"
        ]);
        $response->assertStatus(200);
        $response->assertJson([
            "email" => "wotacc0809@gmail.com"
        ]);
    }

    public function test_verify(): string
    {
        $this->test_register();
        $response = $this->get('/api/v1/email/employer/verify/' . UserEmployerRegister::first()->token);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "token"
        ]);

        return $response->json('token');
    }

    public function test_finish_register()
    {
        $token = $this->test_verify();
        $response = $this->post('/api/v1/auth/employer/register/finish', [
            "name" => "test",
            "surname" => "test"
        ], ['Authorization' => 'Bearer ' . $token]);
        $response->assertStatus(200);
        $response->assertJson([
            "data" => [
                "name" => "test",
                "surname" => "test"
            ]
        ]);
    }

    public function test_login()
    {
        UserEmployer::factory([
            'email' => 'test@gmail.com',
            'password' => Hash::make('testtest')
        ])->create();
        $response = $this->post('/api/v1/auth/employer/', [
            "email" => "test@gmail.com",
            "password" => "testtest"
        ]);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "token"
        ]);
    }
}
