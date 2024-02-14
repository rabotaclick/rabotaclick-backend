<?php

namespace Tests\Feature;

use App\Models\UserEmployerRegister;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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

    public function test_verify()
    {
        $this->test_register();
        $response = $this->get('/api/v1/email/employer/verify/' . UserEmployerRegister::first()->token);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "token"
        ]);
    }
}
