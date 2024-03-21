<?php declare(strict_types=1);
namespace App\Http\Requests\Vacancy;

use App\DTO\Vacancy\IndexRequestDTO;
use App\Helpers\Contracts\EnumHelperInterface;
use App\Helpers\Contracts\RequestFilterHelperInterface;
use App\Http\Requests\Enums\DateEnum;
use App\Http\Requests\Enums\OrderByEnum;
use App\Http\Requests\Enums\PaginationRequestEnum;
use App\Http\Requests\Vacancy\Contracts\IndexRequestInterface;
use App\Http\Requests\Vacancy\Enums\IndexRequestEnum;
use App\Http\Requests\Vacancy\Enums\VacancyEducationEnum;
use App\Http\Requests\Vacancy\Enums\VacancyOccupationEnum;
use App\Http\Requests\Vacancy\Enums\VacancySalaryEnum;
use App\Http\Requests\Vacancy\Enums\VacancyScheduleEnum;
use App\Http\Requests\Vacancy\Enums\VacancyWorkExperienceEnum;
use App\Models\City;
use App\Providers\Bindings\HelperServiceProvider;
use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest implements IndexRequestInterface
{
    public function rules(): array
    {
        $enumHelper = resolve(EnumHelperInterface::class);
        return [
            PaginationRequestEnum::First->value => 'required|numeric|max:100',
            PaginationRequestEnum::Page->value => 'numeric',

            IndexRequestEnum::Search->value => 'string|max:64',
            IndexRequestEnum::OrderBy->value => 'required|string|in:' . $enumHelper->serialize(OrderByEnum::class),
            IndexRequestEnum::Column->value => 'required|string',
            IndexRequestEnum::Date->value => 'required|string|in:' . $enumHelper->serialize(DateEnum::class),

            IndexRequestEnum::Salary->value => 'string|in:' . $enumHelper->serialize(VacancySalaryEnum::class),
            IndexRequestEnum::IssetSalary->value => 'boolean',

            IndexRequestEnum::CityId->value => 'string|uuid|exists:cities,id',

            IndexRequestEnum::Subspecializations->value => 'array',
            IndexRequestEnum::Subspecializations->value . '.*' => 'string|uuid|exists:subspecializations,id',

            IndexRequestEnum::Education->value => 'string|in:' . $enumHelper->serialize(VacancyEducationEnum::class),

            IndexRequestEnum::WorkExperience->value => 'string|in:' . $enumHelper->serialize(VacancyWorkExperienceEnum::class),

            IndexRequestEnum::Occupation->value => 'string|in:' . $enumHelper->serialize(VacancyOccupationEnum::class),

            IndexRequestEnum::Schedule->value => 'string|in:' . $enumHelper->serialize(VacancyScheduleEnum::class),
        ];
    }

    public function getValidated(): IndexRequestDTO
    {
        $requestParams = $this->validated();

        $filter = resolve(RequestFilterHelperInterface::class, [
            HelperServiceProvider::PARAM_REQUEST_PARAMS => $requestParams,
        ]);

        return new IndexRequestDTO(
            $filter->checkRequestParam(PaginationRequestEnum::First),
            $filter->checkRequestParam(PaginationRequestEnum::Page) ?? 1,
            $filter->checkRequestParam(IndexRequestEnum::Search),
            $filter->checkRequestParam(IndexRequestEnum::OrderBy),
            $filter->checkRequestParam(IndexRequestEnum::Column),
            $filter->checkRequestParam(IndexRequestEnum::Date),
            $filter->checkRequestParam(IndexRequestEnum::Salary),
            $filter->checkRequestParam(IndexRequestEnum::IssetSalary),
            City::find($filter->checkRequestParam(IndexRequestEnum::CityId)),
            $filter->checkRequestParam(IndexRequestEnum::Subspecializations),
            $filter->checkRequestParam(IndexRequestEnum::Education),
            $filter->checkRequestParam(IndexRequestEnum::WorkExperience),
            $filter->checkRequestParam(IndexRequestEnum::Occupation),
            $filter->checkRequestParam(IndexRequestEnum::Schedule),
        );
    }
}
