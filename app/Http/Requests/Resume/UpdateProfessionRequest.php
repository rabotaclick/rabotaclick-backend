<?php

namespace App\Http\Requests\Resume;

use App\DTO\Resume\UpdateProfessionRequestDTO;
use App\Helpers\Contracts\EnumHelperInterface;
use App\Helpers\Contracts\RequestFilterHelperInterface;
use App\Http\Requests\Resume\Contracts\UpdateProfessionRequestInterface;
use App\Http\Requests\Resume\Enums\ResumeOccupationEnum;
use App\Http\Requests\Resume\Enums\ResumeScheduleEnum;
use App\Http\Requests\Resume\Enums\ResumeTravelTimeEnum;
use App\Http\Requests\Resume\Enums\UpdateProfessionRequestEnum;
use App\Providers\Bindings\HelperServiceProvider;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfessionRequest extends FormRequest implements UpdateProfessionRequestInterface
{
    public function rules(): array
    {
        $enumHelper = resolve(EnumHelperInterface::class);
        return [
            UpdateProfessionRequestEnum::Profession->value => 'string|max:128',
            UpdateProfessionRequestEnum::Subspecializations->value => 'array',
            UpdateProfessionRequestEnum::Subspecializations->value . '.add.*' => 'uuid|exists:subspecializations,id',
            UpdateProfessionRequestEnum::Subspecializations->value . '.remove.*' => 'uuid|exists:subspecializations,id',
            UpdateProfessionRequestEnum::Salary->value => 'integer|max:10000000',
            UpdateProfessionRequestEnum::Occupation->value => 'in:' . $enumHelper->serialize(ResumeOccupationEnum::class),
            UpdateProfessionRequestEnum::Schedule->value => 'in:' . $enumHelper->serialize(ResumeScheduleEnum::class),
            UpdateProfessionRequestEnum::TravelTime->value => 'in:' . $enumHelper->serialize(ResumeTravelTimeEnum::class),
        ];
    }

    public function getValidated(): UpdateProfessionRequestDTO
    {
        $requestParams = $this->validated();

        $filter = resolve(RequestFilterHelperInterface::class, [
            HelperServiceProvider::PARAM_REQUEST_PARAMS => $requestParams,
        ]);

        return new UpdateProfessionRequestDTO(
            $filter->checkRequestParam(UpdateProfessionRequestEnum::Profession),
            $filter->checkRequestParam(UpdateProfessionRequestEnum::Subspecializations),
            $filter->checkRequestParam(UpdateProfessionRequestEnum::Salary),
            $filter->checkRequestParam(UpdateProfessionRequestEnum::Occupation),
            $filter->checkRequestParam(UpdateProfessionRequestEnum::Schedule),
            $filter->checkRequestParam(UpdateProfessionRequestEnum::TravelTime),
        );
    }
}
