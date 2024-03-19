<?php

namespace Tests\Feature;

use App\Models\City;
use App\Models\Company;
use App\Models\KeySkill;
use App\Models\Specialization;
use App\Models\Subspecialization;
use App\Models\UserEmployer;
use App\Models\Vacancy;
use App\Models\VacancyPayment;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use function PHPUnit\Framework\assertCount;

class VacancyTest extends TestCase
{
    use RefreshDatabase;
    private string $token;
    private UserEmployer $userEmployer;

    public function setUp(): void
    {
        parent::setUp();
        $city = City::factory()->create();
        $specialization = Specialization::factory()->create();
        City::factory()->create();
        Subspecialization::factory([
            'specialization_id' => $specialization->id
        ])->create();
        KeySkill::factory()->create();
        $company = Company::factory([
            'city_id' => $city->id,
            'specialization_id' => $specialization->id
        ])->create();
        $this->userEmployer = UserEmployer::factory([
            'company_id' => $company->id
        ])->create();
        $this->token = $this->userEmployer->createToken('auth-token', ['role:employer'])->plainTextToken;
    }

    public function test_create_vacancy(): string
    {
        $response = $this->post('/api/v1/employer/company/vacancy', [
            "title" => "Test",
            "salary_type" => "in_hand",
            "salary_from" => "100000",
            "salary_to" => "200000",
            "work_experience" => "one_to_three",
            "occupation" => "full-time",
            "gpc" => true,
            "work_type" => "full_job",
            "schedule" => "full",
            "subspecializations" => array(Subspecialization::first()->id),
            "key_skills" => array(KeySkill::first()->id),
            "city_id" => City::first()->id,
            "responsibilities" => "test",
            "requirements" => "test",
            "conditions" => "test",
            "education" => "high",
            "contact_name" => "andrew",
            "contact_surname" => "vasilev",
            "contact_lastname" => "mikhailovich",
            "contact_phone" => "+79243609722",
            "contact_email" => "wotacc0809@gmail.com",
            "letter" => "test",
            "vacancy_type" => "standard"
        ], ['Authorization' => 'Bearer ' . $this->token]);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "invoiceID",
            "amount",
            "user"
        ]);
        return $response->json('invoiceID');
    }

    public function test_cloudpayments_check(): string
    {
        $invoiceID = $this->test_create_vacancy();
        $response = $this->post('/api/v1/webhooks/cloudpayments/check', [
            "InvoiceId" => $invoiceID,
            "AccountId" => $this->userEmployer->id,
            "DateTime" => now()->format('Y-m-d H:i:s'),
            "Amount" => 700,
            "TransactionId" => "test"
        ], ['Authorization' => 'Bearer ' . $this->token]);
        $response->assertStatus(200);
        $response->assertJson([
            "code" => 0
        ]);
        return $invoiceID;
    }

    public function test_cloudpayments_pay()
    {
        $invoiceID = $this->test_cloudpayments_check();
        $response = $this->post('/api/v1/webhooks/cloudpayments/pay', [
            "InvoiceId" => $invoiceID,
            "AccountId" => $this->userEmployer->id,
            "DateTime" => now()->format('Y-m-d H:i:s'),
            "Amount" => 700,
            "TransactionId" => "test"
        ], ['Authorization' => 'Bearer ' . $this->token]);
        $response->assertStatus(200);
        $response->assertJson([
            "code" => 0
        ]);
    }

    public function test_get_vacancy()
    {
        $this->test_create_vacancy();
        $response = $this->get('/api/v1/vacancies/' . Vacancy::first()->id);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'id',
                'title'
            ]
        ]);
    }

    public function test_delete_vacancy_if_not_payed()
    {
        $this->test_create_vacancy();
        $this->travelTo(now()->addDays(32));
        $this->artisan('app:delete-vacancies');
        $vacancies = Vacancy::all();
        assertCount(0,$vacancies);
    }

    public function test_disable_vacancy_if_expired()
    {
        $this->test_cloudpayments_pay();
        $this->travelTo(now()->addDays(32));
        $this->artisan('app:disable-vacancies');
        $vacancy = Vacancy::first()->toArray();
        self::assertContainsEquals(['is_active' => false], $vacancy);
    }
}
