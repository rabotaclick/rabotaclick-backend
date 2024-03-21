<?php declare(strict_types=1);
namespace App\Http\Requests\Vacancy;

use App\DTO\Vacancy\StoreRequestDTO;
use App\Helpers\Contracts\EnumHelperInterface;
use App\Helpers\Contracts\RequestFilterHelperInterface;
use App\Http\Requests\Vacancy\Contracts\StoreRequestInterface;
use App\Http\Requests\Vacancy\Enums\StoreRequestEnum;
use App\Http\Requests\Vacancy\Enums\VacancyEducationEnum;
use App\Http\Requests\Vacancy\Enums\VacancyOccupationEnum;
use App\Http\Requests\Vacancy\Enums\VacancySalaryTypeEnum;
use App\Http\Requests\Vacancy\Enums\VacancyScheduleEnum;
use App\Http\Requests\Vacancy\Enums\VacancyTypeEnum;
use App\Http\Requests\Vacancy\Enums\VacancyWorkExperienceEnum;
use App\Http\Requests\Vacancy\Enums\VacancyWorkTypeEnum;
use App\Models\City;
use App\Models\KeySkill;
use App\Models\Subspecialization;
use App\Providers\Bindings\HelperServiceProvider;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest implements StoreRequestInterface
{
    public function rules(): array
    {
        $enumHelper = resolve(EnumHelperInterface::class);
        return [
            StoreRequestEnum::Title->value =>                       'required|string|max:32',
            StoreRequestEnum::SalaryType->value =>                  'required|in:' . $enumHelper->serialize(VacancySalaryTypeEnum::class),
            StoreRequestEnum::SalaryFrom->value =>                  'required|integer|max:9999999',
            StoreRequestEnum::SalaryTo->value =>                    'required|integer|max:10000000',
            StoreRequestEnum::WorkExperience->value =>              'required|in:' . $enumHelper->serialize(VacancyWorkExperienceEnum::class),
            StoreRequestEnum::Occupation->value =>                  'required|in:' . $enumHelper->serialize(VacancyOccupationEnum::class),
            StoreRequestEnum::GPC->value =>                         'required|boolean',
            StoreRequestEnum::WorkType->value =>                    'required|in:' . $enumHelper->serialize(VacancyWorkTypeEnum::class),
            StoreRequestEnum::Schedule->value =>                    'required|in:' . $enumHelper->serialize(VacancyScheduleEnum::class),
            StoreRequestEnum::Subspecializations->value =>          'required|array',
            StoreRequestEnum::Subspecializations->value . '.*' =>   'required|uuid|exists:subspecializations,id',
            StoreRequestEnum::KeySkills->value =>                   'array',
            StoreRequestEnum::KeySkills->value . '.*' =>            'required|uuid|exists:key_skills,id',
            StoreRequestEnum::CityId->value =>                      'required|uuid|exists:cities,id',
            StoreRequestEnum::Responsibilities->value =>            'required|string|max:5000',
            StoreRequestEnum::Requirements->value =>                'required|string|max:5000',
            StoreRequestEnum::Conditions->value =>                  'required|string|max:5000',
            StoreRequestEnum::Education->value =>                   'required|in:' . $enumHelper->serialize(VacancyEducationEnum::class),
            StoreRequestEnum::ContactName->value =>                 'required|string|max:32',
            StoreRequestEnum::ContactSurname->value =>              'required|string|max:32',
            StoreRequestEnum::ContactLastname->value =>             'string|max:32',
            StoreRequestEnum::ContactPhone->value =>                'required|string|max:32|regex:/^([0-9\s\-\+\(\)]*)$/|min:11',
            StoreRequestEnum::ContactEmail->value =>                'required|string|email|max:128',
            StoreRequestEnum::Letter->value =>                      'required|string|max:5000',
            StoreRequestEnum::VacancyType->value =>                 'required|in:' . $enumHelper->serialize(VacancyTypeEnum::class),
        ];
    }

    public function getValidated(): StoreRequestDTO
    {
        $requestParams = $this->validated();

        $filter = resolve(RequestFilterHelperInterface::class, [
            HelperServiceProvider::PARAM_REQUEST_PARAMS => $requestParams,
        ]);

        return new StoreRequestDTO(
            $filter->checkRequestParam(StoreRequestEnum::Title),
            $filter->checkRequestParam(StoreRequestEnum::SalaryType),
            intval($filter->checkRequestParam(StoreRequestEnum::SalaryFrom)),
            intval($filter->checkRequestParam(StoreRequestEnum::SalaryTo)),
            $filter->checkRequestParam(StoreRequestEnum::WorkExperience),
            $filter->checkRequestParam(StoreRequestEnum::Occupation),
            $filter->checkRequestParam(StoreRequestEnum::GPC),
            $filter->checkRequestParam(StoreRequestEnum::WorkType),
            $filter->checkRequestParam(StoreRequestEnum::Schedule),
            Subspecialization::whereIn('id',$filter->checkRequestParam(StoreRequestEnum::Subspecializations))->get(),
            KeySkill::whereIn('id',$filter->checkRequestParam(StoreRequestEnum::KeySkills))->get(),
            City::find($filter->checkRequestParam(StoreRequestEnum::CityId)),
            $filter->checkRequestParam(StoreRequestEnum::Responsibilities),
            $filter->checkRequestParam(StoreRequestEnum::Requirements),
            $filter->checkRequestParam(StoreRequestEnum::Conditions),
            $filter->checkRequestParam(StoreRequestEnum::Education),
            $filter->checkRequestParam(StoreRequestEnum::ContactName),
            $filter->checkRequestParam(StoreRequestEnum::ContactSurname),
            $filter->checkRequestParam(StoreRequestEnum::ContactLastname),
            normalizePhone($filter->checkRequestParam(StoreRequestEnum::ContactPhone)),
            $filter->checkRequestParam(StoreRequestEnum::ContactEmail),
            $filter->checkRequestParam(StoreRequestEnum::Letter),
            $filter->checkRequestParam(StoreRequestEnum::VacancyType),
        );
    }
}
