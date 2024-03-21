<?php declare(strict_types=1);
namespace App\Http\Requests\Resume;

use App\DTO\Resume\IndexRequestDTO;
use App\Helpers\Contracts\EnumHelperInterface;
use App\Helpers\Contracts\RequestFilterHelperInterface;
use App\Http\Requests\EducationPlace\Enums\EducationPlaceEducationEnum;
use App\Http\Requests\Enums\DateEnum;
use App\Http\Requests\Enums\OrderByEnum;
use App\Http\Requests\Enums\PaginationRequestEnum;
use App\Http\Requests\Resume\Contracts\IndexRequestInterface;
use App\Http\Requests\Resume\Enums\IndexRequestEnum;
use App\Http\Requests\Resume\Enums\ResumeGenderEnum;
use App\Http\Requests\Resume\Enums\ResumeOccupationEnum;
use App\Http\Requests\Resume\Enums\ResumeReadyToMoveEnum;
use App\Http\Requests\Resume\Enums\ResumeScheduleEnum;
use App\Http\Requests\Resume\Enums\ResumeWorkExperienceEnum;
use App\Http\Requests\Resume\Enums\ResumeWorkHistoryDateEnum;
use App\Http\Requests\User\Enums\UpdateRequestStatusEnum;
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
            IndexRequestEnum::CityId->value => 'string|uuid|exists:cities,id',
            IndexRequestEnum::ReadyToMove->value => 'string|in:' . $enumHelper->serialize(ResumeReadyToMoveEnum::class),

            IndexRequestEnum::WorkHistorySpecializations->value => 'array',
            IndexRequestEnum::WorkHistorySpecializations->value . '.subspecializations' => 'required_with:'. IndexRequestEnum::WorkHistorySpecializations->value . '.date' .'|array',
            IndexRequestEnum::WorkHistorySpecializations->value . '.subspecializations.*' => 'required|string|uuid|exists:subspecializations,id',
            IndexRequestEnum::WorkHistorySpecializations->value . '.date' => 'required_with:'. IndexRequestEnum::WorkHistorySpecializations->value . '.subspecializations|string|in:' . $enumHelper->serialize(ResumeWorkHistoryDateEnum::class),

            IndexRequestEnum::UserStatus->value => 'string|in:' . $enumHelper->serialize(UpdateRequestStatusEnum::class),

            IndexRequestEnum::Age->value => 'array',
            IndexRequestEnum::Age->value . '.from' => 'required_with:'. IndexRequestEnum::Age->value . '.to' .'|lte:'. IndexRequestEnum::Age->value . '.to' .'|numeric|max:100',
            IndexRequestEnum::Age->value . '.to' => 'required_with:'. IndexRequestEnum::Age->value . '.from' .'|numeric|max:120',
            IndexRequestEnum::IssetAge->value => 'boolean',

            IndexRequestEnum::Occupation->value => 'string|in:' . $enumHelper->serialize(ResumeOccupationEnum::class),
            IndexRequestEnum::Schedule->value => 'string|in:' . $enumHelper->serialize(ResumeScheduleEnum::class),
            IndexRequestEnum::WorkExperience->value => 'string|in:' . $enumHelper->serialize(ResumeWorkExperienceEnum::class),

            IndexRequestEnum::Subspecializations->value => 'array',
            IndexRequestEnum::Subspecializations->value . '.*' => 'string|uuid|exists:subspecializations,id',

            IndexRequestEnum::Gender->value => 'in:' . $enumHelper->serialize(ResumeGenderEnum::class),
            IndexRequestEnum::IssetGender->value => 'boolean',

            IndexRequestEnum::Salary->value => 'array',
            IndexRequestEnum::Salary->value . '.from' => 'required_with:'. IndexRequestEnum::Salary->value . '.to' .'|lte:'. IndexRequestEnum::Salary->value . '.to' .'|numeric|max:10000000',
            IndexRequestEnum::Salary->value . '.to' => 'required_with:'. IndexRequestEnum::Salary->value . '.from' .'|numeric|max:10000000',
            IndexRequestEnum::IssetSalary->value => 'boolean',

            IndexRequestEnum::Education->value => 'string|in:' . $enumHelper->serialize(EducationPlaceEducationEnum::class)
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
            City::find($filter->checkRequestParam(IndexRequestEnum::CityId)),
            $filter->checkRequestParam(IndexRequestEnum::ReadyToMove),
            $filter->checkRequestParam(IndexRequestEnum::WorkHistorySpecializations),
            $filter->checkRequestParam(IndexRequestEnum::UserStatus),
            $filter->checkRequestParam(IndexRequestEnum::Age),
            $filter->checkRequestParam(IndexRequestEnum::IssetAge),
            $filter->checkRequestParam(IndexRequestEnum::Occupation),
            $filter->checkRequestParam(IndexRequestEnum::Schedule),
            $filter->checkRequestParam(IndexRequestEnum::WorkExperience),
            $filter->checkRequestParam(IndexRequestEnum::Subspecializations),
            $filter->checkRequestParam(IndexRequestEnum::Gender),
            $filter->checkRequestParam(IndexRequestEnum::IssetGender),
            $filter->checkRequestParam(IndexRequestEnum::Salary),
            $filter->checkRequestParam(IndexRequestEnum::IssetSalary),
            $filter->checkRequestParam(IndexRequestEnum::Education),
        );
    }
}
