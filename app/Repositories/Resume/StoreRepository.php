<?php declare(strict_types=1);
namespace App\Repositories\Resume;

use App\DTO\Resume\ResumeDTO;
use App\DTO\Resume\StoreRequestDTO;
use App\Models\EducationPlace;
use App\Models\Resume;
use App\Models\Subspecialization;
use App\Models\WorkHistory;
use App\Repositories\Resume\Exceptions\TooManyResumesException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StoreRepository
{
    public function __construct(
        private Resume $resume
    )
    {
    }
    public function checkUserLimits()
    {
        $user = Auth::user();
        if($user->resumes()->count() >= 5) {
            throw new TooManyResumesException();
        }
    }
    public function make(StoreRequestDTO $requestDTO): ResumeDTO
    {
        DB::transaction(function() use($requestDTO){
            $this->resume->surname = $requestDTO->surname;
            $this->resume->name = $requestDTO->name;
            $this->resume->lastname = $requestDTO->lastname;
            $this->resume->birthdate = $requestDTO->birthdate->format('Y-m-d');
            $this->resume->gender = $requestDTO->gender;
            $this->resume->city_id = $requestDTO->city->id;
            $this->resume->ready_to_move = $requestDTO->ready_to_move;
            $this->resume->business_trips = $requestDTO->business_trips;
            $this->resume->profession = $requestDTO->profession;
            $this->resume->salary = $requestDTO->salary;
            $this->resume->occupation = $requestDTO->occupation;
            $this->resume->schedule = $requestDTO->schedule;
            $this->resume->about_me = $requestDTO->about_me;
            $this->resume->have_car = $requestDTO->have_car;
            $this->resume->main_language_id = $requestDTO->main_language->id;
            $this->resume->citizenship_country_id = $requestDTO->citizenship->id;
            $this->resume->work_permit_country_id = $requestDTO->work_permit->id;
            $this->resume->travel_time = $requestDTO->travel_time;
            $this->resume->phone = $requestDTO->phone;
            $this->resume->email = $requestDTO->email;
            $this->resume->preferred_contact = $requestDTO->preferred_contact;
            $this->resume->user_id = Auth::user()->id;
            $this->resume->save();

            $this->attachSubspecializations($requestDTO->subspecializations);
            $this->createWorkHistories($requestDTO->work_histories);
            $this->attachKeySkills($requestDTO->key_skills);
            $this->attachDriverCategories($requestDTO->driver_categories);
            $this->createEducationPlaces($requestDTO->education_places);
            $this->attachLanguages($requestDTO->languages);
        });
        return new ResumeDTO(
            $this->resume
        );
    }

    private function attachSubspecializations($subspecializations)
    {
        foreach ($subspecializations as $subspecialization) {
            $this->resume->subspecializations()->syncWithoutDetaching($subspecialization);
        }
    }

    private function createWorkHistories($work_histories)
    {
        foreach ($work_histories as $work_history_object) {
            $work_history_object['resume_id'] = $this->resume->id;
            $work_history = WorkHistory::create($work_history_object);
            foreach ($work_history_object['subspecializations'] as $subspecialization) {
                $work_history->subspecializations()->syncWithoutDetaching($subspecialization);
            }
        }
    }

    private function attachKeySkills($key_skills)
    {
        foreach ($key_skills as $key_skill) {
            $this->resume->key_skills()->syncWithoutDetaching($key_skill);
        }
    }

    private function attachDriverCategories($driver_categories)
    {
        foreach ($driver_categories as $driver_category) {
            $this->resume->driver_categories()->syncWithoutDetaching($driver_category);
        }
    }

    private function createEducationPlaces($education_places)
    {
        foreach ($education_places as $education_place_object) {
            $education_place_object['resume_id'] = $this->resume->id;
            EducationPlace::create($education_place_object);
        }
    }

    private function attachLanguages($languages)
    {
        foreach ($languages as $language) {
            $this->resume->languages()->syncWithPivotValues($language['language_id'], ['level' => $language['level']]);
        }
    }


}
