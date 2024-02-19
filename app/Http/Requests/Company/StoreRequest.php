<?php

namespace App\Http\Requests\Company;

use App\DTO\Company\StoreRequestDTO;
use App\Helpers\Contracts\EnumHelperInterface;
use App\Helpers\Contracts\RequestFilterHelperInterface;
use App\Http\Requests\Company\Contracts\StoreRequestInterface;
use App\Http\Requests\Company\Enums\CompanyTypeEnum;
use App\Http\Requests\Company\Enums\StoreRequestEnum;
use App\Models\City;
use App\Models\Specialization;
use App\Providers\Bindings\HelperServiceProvider;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest implements StoreRequestInterface
{
    public function rules(): array
    {
        $enumHelper = resolve(EnumHelperInterface::class);
        return [
            StoreRequestEnum::Type->value => 'required|in:' . $enumHelper->serialize(CompanyTypeEnum::class),
            StoreRequestEnum::Name->value => 'required|string|max:32',
            StoreRequestEnum::CityId->value => 'required|uuid|exists:cities,id',
            StoreRequestEnum::Website->value => 'string|url|max:128',
            StoreRequestEnum::SpecializationId->value => 'required|uuid|exists:specializations,id',
            StoreRequestEnum::Phone->value => 'required|string|max:32|regex:/^([0-9\s\-\+\(\)]*)$/|min:11',
            StoreRequestEnum::Description->value => 'string|max:5000',
            StoreRequestEnum::Document->value => 'file|max:10000|mimes:doc,docx,pdf,png,jpg'
        ];
    }

    public function getValidated(): StoreRequestDTO
    {
        $requestParams = $this->validated();

        $filter = resolve(RequestFilterHelperInterface::class, [
            HelperServiceProvider::PARAM_REQUEST_PARAMS => $requestParams,
        ]);

        return new StoreRequestDTO(
            $filter->checkRequestParam(StoreRequestEnum::Type),
            $filter->checkRequestParam(StoreRequestEnum::Name),
            City::find($filter->checkRequestParam(StoreRequestEnum::CityId)),
            $filter->checkRequestParam(StoreRequestEnum::Website),
            Specialization::find($filter->checkRequestParam(StoreRequestEnum::SpecializationId)),
            normalizePhone($filter->checkRequestParam(StoreRequestEnum::Phone)),
            $filter->checkRequestParam(StoreRequestEnum::Description),
            $filter->checkRequestParam(StoreRequestEnum::Document),
        );
    }
}
