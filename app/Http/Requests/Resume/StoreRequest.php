<?php declare(strict_types=1);
namespace App\Http\Requests\Resume;

use App\DTO\Resume\StoreRequestDTO;
use App\Helpers\Contracts\EnumHelperInterface;
use App\Helpers\Contracts\RequestFilterHelperInterface;
use App\Http\Requests\EducationPlace\Enums\EducationPlaceEducationEnum;
use App\Http\Requests\Language\Enums\LanguageLevelEnum;
use App\Http\Requests\Resume\Contracts\StoreRequestInterface;
use App\Http\Requests\Resume\Enums\ResumeBusinessTripsEnum;
use App\Http\Requests\Resume\Enums\ResumeGenderEnum;
use App\Http\Requests\Resume\Enums\ResumeOccupationEnum;
use App\Http\Requests\Resume\Enums\ResumePreferredContactEnum;
use App\Http\Requests\Resume\Enums\ResumeReadyToMoveEnum;
use App\Http\Requests\Resume\Enums\ResumeScheduleEnum;
use App\Http\Requests\Resume\Enums\ResumeTravelTimeEnum;
use App\Http\Requests\Resume\Enums\StoreRequestEnum;
use App\Models\City;
use App\Models\Country;
use App\Models\Language;
use App\Providers\Bindings\HelperServiceProvider;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest implements StoreRequestInterface
{
    public function rules(): array
    {
        $enumHelper = resolve(EnumHelperInterface::class);
        return [
            StoreRequestEnum::Name->value => 'required|string|max:32',
            StoreRequestEnum::Surname->value => 'required|string|max:32',
            StoreRequestEnum::Lastname->value => 'string|max:32',
            StoreRequestEnum::Birthdate->value => 'required|date_format:Y-m-d|before_or_equal:'. now()->subYears(14)->format('Y-m-d'),
            StoreRequestEnum::Gender->value => 'required|in:' . $enumHelper->serialize(ResumeGenderEnum::class),
            StoreRequestEnum::CityId->value => 'required|uuid|exists:cities,id',
            StoreRequestEnum::ReadyToMove->value => 'required|in:' . $enumHelper->serialize(ResumeReadyToMoveEnum::class),
            StoreRequestEnum::BusinessTrips->value => 'required|in:' . $enumHelper->serialize(ResumeBusinessTripsEnum::class),

            StoreRequestEnum::Profession->value => 'required|string|max:128',
            StoreRequestEnum::Subspecializations->value => 'required|array',
            StoreRequestEnum::Subspecializations->value . '.*' => 'required|uuid|exists:subspecializations,id',
            StoreRequestEnum::Salary->value => 'required|integer|max:10000000',
            StoreRequestEnum::Occupation->value => 'required|in:' . $enumHelper->serialize(ResumeOccupationEnum::class),
            StoreRequestEnum::Schedule->value => 'required|in:' . $enumHelper->serialize(ResumeScheduleEnum::class),

            StoreRequestEnum::WorkHistories->value => 'array', // nullable
            StoreRequestEnum::WorkHistories->value . '.*.start_date' => 'required|date_format:Y-m-d|before_or_equal:' . now()->format('Y-m-d'),
            StoreRequestEnum::WorkHistories->value . '.*.end_date' => 'date_format:Y-m-d|before_or_equal:' . now()->format('Y-m-d'), // nullable
            StoreRequestEnum::WorkHistories->value . '.*.organization' => 'required|string|max:128',
            StoreRequestEnum::WorkHistories->value . '.*.region_id' => 'required|uuid|exists:regions,id',
            StoreRequestEnum::WorkHistories->value . '.*.website_url' => 'url|max:255', // nullable
            StoreRequestEnum::WorkHistories->value . '.*.subspecializations' => 'array', // nullable
            StoreRequestEnum::WorkHistories->value . '.*.subspecializations.*' => 'required|uuid|exists:subspecializations,id',
            StoreRequestEnum::WorkHistories->value . '.*.job' => 'required|string|max:128',
            StoreRequestEnum::WorkHistories->value . '.*.description' => 'required|string|max:5000',

            StoreRequestEnum::KeySkills->value => 'array', // nullable
            StoreRequestEnum::KeySkills->value . '.*' => 'required|uuid|exists:key_skills,id',

            StoreRequestEnum::AboutMe->value => 'string|max:5000',
            StoreRequestEnum::HaveCar->value => 'required|boolean',

            StoreRequestEnum::DriverCategories->value => 'array', // nullable
            StoreRequestEnum::DriverCategories->value . '.*' => 'required|uuid|exists:driver_categories,id',

            StoreRequestEnum::EducationPlaces->value => 'array', // nullable
            StoreRequestEnum::EducationPlaces->value . '.*.education' => 'required|in:' . $enumHelper->serialize(EducationPlaceEducationEnum::class),
            StoreRequestEnum::EducationPlaces->value . '.*.name' => 'required|string|max:255',
            StoreRequestEnum::EducationPlaces->value . '.*.faculty' => 'required|string|max:255',
            StoreRequestEnum::EducationPlaces->value . '.*.specialization' => 'required|string|max:255',
            StoreRequestEnum::EducationPlaces->value . '.*.year_of_ending' => 'required|date_format:Y',

            StoreRequestEnum::MainLanguageId->value => 'required|uuid|exists:languages,id',
            StoreRequestEnum::Languages->value => 'array', // nullable,
            StoreRequestEnum::Languages->value . '.*.language_id' => 'required|exists:languages,id',
            StoreRequestEnum::Languages->value . '.*.level' => 'required|in:' . $enumHelper->serialize(LanguageLevelEnum::class),

            StoreRequestEnum::CitizenshipCountryId->value => 'required|uuid|exists:countries,id',
            StoreRequestEnum::WorkPermitCountryId->value => 'required|uuid|exists:countries,id',
            StoreRequestEnum::TravelTime->value => 'required|in:' . $enumHelper->serialize(ResumeTravelTimeEnum::class),

            StoreRequestEnum::Phone->value => 'required|string|max:32|regex:/^([0-9\s\-\+\(\)]*)$/|min:11',
            StoreRequestEnum::Email->value => 'required|string|email|max:128',
            StoreRequestEnum::PreferredContact->value => 'required|in:' . $enumHelper->serialize(ResumePreferredContactEnum::class)
        ];
    }

    public function getValidated(): StoreRequestDTO
    {
        $requestParams = $this->validated();

        $filter = resolve(RequestFilterHelperInterface::class, [
            HelperServiceProvider::PARAM_REQUEST_PARAMS => $requestParams,
        ]);

        return new StoreRequestDTO(
            $filter->checkRequestParam(StoreRequestEnum::Name),
            $filter->checkRequestParam(StoreRequestEnum::Surname),
            $filter->checkRequestParam(StoreRequestEnum::Lastname),
            Carbon::parse($filter->checkRequestParam(StoreRequestEnum::Birthdate)),
            $filter->checkRequestParam(StoreRequestEnum::Gender),
            City::find($filter->checkRequestParam(StoreRequestEnum::CityId)),
            $filter->checkRequestParam(StoreRequestEnum::ReadyToMove),
            $filter->checkRequestParam(StoreRequestEnum::BusinessTrips),
            $filter->checkRequestParam(StoreRequestEnum::Profession),
            Collection::make($filter->checkRequestParam(StoreRequestEnum::Subspecializations)),
            $filter->checkRequestParam(StoreRequestEnum::Salary),
            $filter->checkRequestParam(StoreRequestEnum::Occupation),
            $filter->checkRequestParam(StoreRequestEnum::Schedule),
            Collection::make($filter->checkRequestParam(StoreRequestEnum::WorkHistories)),
            Collection::make($filter->checkRequestParam(StoreRequestEnum::KeySkills)),
            $filter->checkRequestParam(StoreRequestEnum::AboutMe),
            $filter->checkRequestParam(StoreRequestEnum::HaveCar),
            Collection::make($filter->checkRequestParam(StoreRequestEnum::DriverCategories)),
            Collection::make($filter->checkRequestParam(StoreRequestEnum::EducationPlaces)),
            Language::find($filter->checkRequestParam(StoreRequestEnum::MainLanguageId)),
            $filter->checkRequestParam(StoreRequestEnum::Languages),
            Country::find($filter->checkRequestParam(StoreRequestEnum::CitizenshipCountryId)),
            Country::find($filter->checkRequestParam(StoreRequestEnum::WorkPermitCountryId)),
            $filter->checkRequestParam(StoreRequestEnum::TravelTime),
            normalizePhone($filter->checkRequestParam(StoreRequestEnum::Phone)),
            $filter->checkRequestParam(StoreRequestEnum::Email),
            $filter->checkRequestParam(StoreRequestEnum::PreferredContact),
        );
    }
}
