<?php

namespace Tests\Feature;

use App\Models\KeySkill;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class KeySkillTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        KeySkill::factory()->create();
    }

    public function test_index_key_skill()
    {
        $response = $this->get('/api/v1/key_skills');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "data" => [
                [
                    "id",
                    "title"
                ]
            ]
        ]);
    }
}
