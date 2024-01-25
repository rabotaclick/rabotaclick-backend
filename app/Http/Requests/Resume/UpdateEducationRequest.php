<?php

namespace App\Http\Requests\Resume;

use App\DTO\Resume\UpdateEducationRequestDTO;
use App\Helpers\Contracts\EnumHelperInterface;
use App\Helpers\Contracts\RequestFilterHelperInterface;
use App\Http\Requests\EducationPlace\Enums\EducationPlaceEducationEnum;
use App\Http\Requests\Resume\Contracts\UpdateEducationRequestInterface;
use App\Http\Requests\Resume\Enums\UpdateEducationRequestEnum;
use App\Providers\Bindings\HelperServiceProvider;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEducationRequest extends FormRequest implements UpdateEducationRequestInterface
{
    public function rules(): array
    {
        $enumHelper = resolve(EnumHelperInterface::class);
        return [
            UpdateEducationRequestEnum::EducationPlaces->value => 'array',
            UpdateEducationRequestEnum::EducationPlaces->value . '.create.*.education' => 'required|in:' . $enumHelper->serialize(EducationPlaceEducationEnum::class),
            UpdateEducationRequestEnum::EducationPlaces->value . '.create.*.name' => 'required|string|max:255',
            UpdateEducationRequestEnum::EducationPlaces->value . '.create.*.faculty' => 'required|string|max:255',
            UpdateEducationRequestEnum::EducationPlaces->value . '.create.*.specialization' => 'required|string|max:255',
            UpdateEducationRequestEnum::EducationPlaces->value . '.create.*.year_of_ending' => 'required|date_format:Y',

            UpdateEducationRequestEnum::EducationPlaces->value . '.delete.*' => 'uuid|exists:education_places,id',

            UpdateEducationRequestEnum::EducationPlaces->value . '.update.*.id' => 'required|uuid|exists:education_places,id',
            UpdateEducationRequestEnum::EducationPlaces->value . '.update.*.education' => 'in:' . $enumHelper->serialize(EducationPlaceEducationEnum::class),
            UpdateEducationRequestEnum::EducationPlaces->value . '.update.*.name' => 'string|max:255',
            UpdateEducationRequestEnum::EducationPlaces->value . '.update.*.faculty' => 'string|max:255',
            UpdateEducationRequestEnum::EducationPlaces->value . '.update.*.specialization' => 'string|max:255',
            UpdateEducationRequestEnum::EducationPlaces->value . '.update.*.year_of_ending' => 'date_format:Y',
        ];
    }

    public function getValidated(): UpdateEducationRequestDTO
    {
        $requestParams = $this->validated();

        $filter = resolve(RequestFilterHelperInterface::class, [
            HelperServiceProvider::PARAM_REQUEST_PARAMS => $requestParams,
        ]);

        return new UpdateEducationRequestDTO(
            $filter->checkRequestParam(UpdateEducationRequestEnum::EducationPlaces)
        );
    }
}
