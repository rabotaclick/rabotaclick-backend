<?php

namespace App\DTO\Resume;

use App\Http\Requests\Resume\Enums\ResumeBusinessTripsEnum;
use App\Http\Requests\Resume\Enums\ResumeGenderEnum;
use App\Http\Requests\Resume\Enums\ResumeOccupationEnum;
use App\Http\Requests\Resume\Enums\ResumePreferredContactEnum;
use App\Http\Requests\Resume\Enums\ResumeReadyToMoveEnum;
use App\Http\Requests\Resume\Enums\ResumeScheduleEnum;
use App\Http\Requests\Resume\Enums\ResumeTravelTimeEnum;
use App\Models\City;
use App\Models\Country;
use App\Models\Language;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

readonly class StoreRequestDTO
{
    public function __construct(
        public string                       $surname,
        public string                       $name,
        public string                       $lastname,
        public Carbon                       $birthdate,
        public string                       $gender,
        public City                         $city,
        public string                       $ready_to_move,
        public string                       $business_trips,

        public string                       $profession,
        public Collection                   $subspecializations,
        public int                          $salary,
        public string                       $occupation,
        public string                       $schedule,

        public Collection|null              $work_histories = null,
        public Collection|null              $key_skills = null,
        public string|null                  $about_me = null,
        public bool                         $have_car,
        public Collection|null              $driver_categories = null,

        public Collection|null              $education_places = null,

        public Language                     $main_language,
        public array                        $languages,

        public Country                      $citizenship,
        public Country                      $work_permit,
        public string                       $travel_time,

        public string                       $phone,
        public string                       $email,
        public string                       $preferred_contact
    )
    {
    }
}
