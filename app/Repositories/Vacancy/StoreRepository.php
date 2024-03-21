<?php declare(strict_types=1);
namespace App\Repositories\Vacancy;

use App\DTO\Vacancy\StoreRequestDTO;
use App\DTO\Vacancy\StoreResponseDTO;
use App\DTO\Vacancy\VacancyDTO;
use App\Models\UserEmployer;
use App\Models\Vacancy;
use App\Models\VacancyPayment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StoreRepository
{
    public function __construct(
        public Vacancy $vacancy,
        public UserEmployer $userEmployer
    )
    {
    }

    public function make(StoreRequestDTO $requestDTO): StoreResponseDTO
    {
        $payment = DB::transaction(function () use($requestDTO) {
            $this->userEmployer = Auth::user();
            $requestDTOArray = $requestDTO->toArray();
            $requestDTOArray = array_merge($requestDTOArray,['company_id' => $this->userEmployer->company->id]);
            $this->vacancy = Vacancy::create($requestDTOArray);
            $this->attachSubspecializations($requestDTO->subspecializations);
            $this->attachKeySkills($requestDTO->key_skills);
            return $this->createPayment($requestDTO->vacancy_type);
        });
        return new StoreResponseDTO(
            $payment->id,
            $payment->summary,
            $this->userEmployer->makeHidden(['company','company_id','created_at','updated_at','deleted_at'])
        );
    }
    private function attachSubspecializations($subspecializations)
    {
        foreach ($subspecializations as $subspecialization) {
            $this->vacancy->subspecializations()->syncWithoutDetaching($subspecialization);
        }
    }
    private function attachKeySkills($key_skills)
    {
        foreach ($key_skills as $key_skill) {
            $this->vacancy->key_skills()->syncWithoutDetaching($key_skill);
        }
    }
    private function createPayment($vacancy_type): VacancyPayment
    {
        $summary = match($vacancy_type) {
            'standard' => 700,
            'premium' => 900
        };
        $payment = new VacancyPayment();
        $payment->vacancy_type = $vacancy_type;
        $payment->summary = $summary;
        $payment->vacancy_id = $this->vacancy->id;
        $payment->user_employer_id = $this->userEmployer->id;
        $payment->save();
        return $payment;
    }
}
