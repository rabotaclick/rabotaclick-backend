<?php

namespace Tests\Feature;

use App\Models\City;
use App\Models\Country;
use App\Models\DriverCategory;
use App\Models\EducationPlace;
use App\Models\KeySkill;
use App\Models\Language;
use App\Models\Region;
use App\Models\Resume;
use App\Models\Subspecialization;
use App\Models\User;
use App\Models\WorkHistory;
use Database\Seeders\Important\DriverCategoriesSeeder;
use Database\Seeders\Important\KeySkillsSeeder;
use Database\Seeders\Important\LanguagesSeeder;
use Database\Seeders\Important\SpecializationsSeeder;
use Database\Seeders\Important\SubjectsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\States\SeedDatabaseState;
use Tests\TestCase;
use Tests\Traits\SeedDatabaseTrait;

class ResumeTest extends TestCase
{
    use RefreshDatabase;

    private string $token;
    public function setUp(): void
    {
        parent::setUp();

        City::factory()->create();
        Subspecialization::factory()->create();
        KeySkill::factory()->create();
        DriverCategory::factory()->create();
        Language::factory()->create();

        $user = User::factory()->create();
        $this->token = $user->createToken('auth-token', ['role:applicant'])->plainTextToken;
    }

    public function test_create_resume()
    {
        $response = $this->post('/api/v1/user/resume/', [
            "name" => "test2",
            "surname" => "test3",
            "lastname" => "test4",
            "birthdate" => "2005-06-14",
            "gender" => "male",
            "city_id" => City::first()->id,
            "ready_to_move" => "yes",
            "business_trips" => "ready",
            "profession" => "Программист",
            "subspecializations" => [
                Subspecialization::first()->id,
            ],
            "salary" => 100000,
            "occupation" => "full-time",
            "schedule" => "full",
            "work_histories" => [
                [
                    "start_date" => "2024-01-19",
                    "end_date" => "2024-01-20",
                    "organization" => "test",
                    "region_id" => Region::first()->id,
                    "website_url" => "https://hi.com",
                    "subspecializations" => [
                        Subspecialization::first()->id,
                    ],
                    "job" => "test",
                    "description" => "test"
                ]
            ],
            "key_skills" => [
                KeySkill::first()->id
            ],
            "about_me" => "hi",
            "have_car" => false,
            "driver_categories" => [
                DriverCategory::first()->id
            ],
            "education_places" => [
                [
                    "education" => "master",
                    "name" => "test",
                    "faculty" => "test",
                    "specialization" => "test",
                    "year_of_ending" => "2026"
                ]
            ],
            "main_language_id" => Language::first()->id,
            "languages" => [
                [
                    "language_id" => Language::first()->id,
                    "level" => "A1"
                ]
            ],
            "citizenship_country_id" => Country::first()->id,
            "work_permit_country_id" => Country::first()->id,
            "travel_time" => "dontcare",
            "phone" => "+79243609722",
            "email" => "wotacc0809@gmail.com",
            "preferred_contact" => "phone"
        ], ['Authorization' => 'Bearer ' . $this->token]);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "data" => [
                "name",
                "surname"
            ]
        ]);
    }

    public function test_delete_resume()
    {
        $this->test_create_resume();
        $response = $this->delete('/api/v1/user/resume/' . Resume::first()->id, [], ['Authorization' => 'Bearer ' . $this->token]);
        $response->assertStatus(200);
        $response->assertJson([
            "status" => true
        ]);
    }

    public function test_update_resume_personal()
    {
        $this->test_create_resume();
        $response = $this->put('/api/v1/user/resume/' . Resume::first()->id . '/personal', [
            "name" => "test2",
            "surname" => "test3",
            "lastname" => "test4",
            "birthdate" => "2005-06-14",
            "gender" => "male",
            "city_id" => City::first()->id,
            "ready_to_move" => "yes",
            "business_trips" => "ready",
            "citizenship_country_id" => Country::first()->id,
            "work_permit_country_id" => Country::first()->id,
        ], ['Authorization' => 'Bearer ' . $this->token]);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "data" => [
                "name",
                "surname"
            ]
        ]);
    }

    public function test_update_resume_contacts()
    {
        $this->test_create_resume();
        $response = $this->put('/api/v1/user/resume/' . Resume::first()->id . '/personal', [
            "phone" => "+79243609722",
            "email" => "info@rabotaclick.pro",
            "preferred_contact" => "phone",
        ], ['Authorization' => 'Bearer ' . $this->token]);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "data" => [
                "name",
                "surname"
            ]
        ]);
    }

    public function test_update_resume_profession()
    {
        $this->test_create_resume();
        $response = $this->put('/api/v1/user/resume/' . Resume::first()->id . '/profession', [
            "profession" => "test",
            "subspecializations" => [
                "add" => [
                    Subspecialization::first()->id
                ],
                "remove" => [
                    Subspecialization::first()->id
                ]
            ],
            "salary" => 100000,
            "occupation" => "part-time",
            "schedule" => "shift",
            "travel_time" => "hour"
        ], ['Authorization' => 'Bearer ' . $this->token]);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "data" => [
                "name",
                "surname"
            ]
        ]);
    }

    public function test_update_resume_working_histories()
    {
        $this->test_create_resume();
        $resume = Resume::first()->id;
        $work_history = WorkHistory::factory(["resume_id" => $resume])->create();
        $response = $this->put('/api/v1/user/resume/' . $resume . '/working_history', [
            "about_me" => "test",
            "have_car" => true,
            "driver_categories" => [
                DriverCategory::first()->id
            ],
            "key_skills" => [
                "create" => [
                    KeySkill::first()->id
                ]
            ],
            "work_histories" => [
                "create" => [
                    [
                        "start_date" => "2024-01-25",
                        "organization" => "test",
                        "region_id" => Region::first()->id,
                        "job" => "test",
                        "description" => "test"
                    ]
                ],
                "delete" => [
                    $work_history->id
                ]
            ]
        ], ['Authorization' => 'Bearer ' . $this->token]);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "data" => [
                "name",
                "surname"
            ]
        ]);
    }

    public function test_update_resume_education()
    {
        $this->test_create_resume();
        $resume = Resume::first()->id;
        $educationPlace = EducationPlace::factory(["resume_id" => $resume])->create();
        $response = $this->put('/api/v1/user/resume/' . $resume . '/education', [
            "education_places" => [
                "create" => [
                    [
                        "education" => "master",
                        "name" => "test",
                        "faculty" => "test",
                        "specialization" => "test",
                        "year_of_ending" => "2030"
                    ]
                ],
                "delete" => [
                    $educationPlace->id
                ]
            ]
        ], ['Authorization' => 'Bearer ' . $this->token]);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "data" => [
                "name",
                "surname"
            ]
        ]);
    }

    public function test_update_resume_languages()
    {
        $this->test_create_resume();
        $resume = Resume::first()->id;
        $response = $this->put('/api/v1/user/resume/' . $resume . '/languages', [
            "main_language_id" => Language::first()->id,
            "languages" => [
                "manipulate" => [
                    [
                        "language_id" => Language::first()->id,
                        "level" => "B2"
                    ]
                ]
            ]
        ], ['Authorization' => 'Bearer ' . $this->token]);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "data" => [
                "name",
                "surname"
            ]
        ]);
    }

    public function test_update_resume_photo()
    {
        $this->test_create_resume();
        $resume = Resume::first()->id;
        $response = $this->put('/api/v1/user/resume/' . $resume . '/photo', [
            "url" => "https://cdn.rabotaclick.pro/photos/phpic5YTD.webp"
        ], ['Authorization' => 'Bearer ' . $this->token]);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "data" => [
                "name",
                "surname"
            ]
        ]);
    }

    public function test_get_resume()
    {
        $this->test_create_resume();
        $resume = Resume::first()->id;
        $response = $this->get('/api/v1/resumes/' . $resume, ['Authorization' => 'Bearer ' . $this->token]);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "data" => [
                "name",
                "surname"
            ]
        ]);
    }
}
