<?php

namespace App\Http\Requests\Resume;

use App\DTO\Resume\UpdateContactsRequestDTO;
use App\Helpers\Contracts\EnumHelperInterface;
use App\Helpers\Contracts\RequestFilterHelperInterface;
use App\Http\Requests\Resume\Contracts\UpdateContactsRequestInterface;
use App\Http\Requests\Resume\Enums\ResumePreferredContactEnum;
use App\Http\Requests\Resume\Enums\StoreRequestEnum;
use App\Http\Requests\Resume\Enums\UpdateContactsRequestEnum;
use App\Providers\Bindings\HelperServiceProvider;
use Illuminate\Foundation\Http\FormRequest;

class UpdateContactsRequest extends FormRequest implements UpdateContactsRequestInterface
{
    public function rules(): array
    {
        $enumHelper = resolve(EnumHelperInterface::class);
        return [
            UpdateContactsRequestEnum::Phone->value => 'string|max:32|regex:/^([0-9\s\-\+\(\)]*)$/|min:11',
            UpdateContactsRequestEnum::Email->value => 'string|email|max:128',
            UpdateContactsRequestEnum::PreferredContact->value => 'in:' . $enumHelper->serialize(ResumePreferredContactEnum::class),
        ];
    }

    public function getValidated(): UpdateContactsRequestDTO
    {
        $requestParams = $this->validated();

        $filter = resolve(RequestFilterHelperInterface::class, [
            HelperServiceProvider::PARAM_REQUEST_PARAMS => $requestParams,
        ]);

        return new UpdateContactsRequestDTO(
            normalizePhone($filter->checkRequestParam(StoreRequestEnum::Phone)),
            $filter->checkRequestParam(StoreRequestEnum::Email),
            $filter->checkRequestParam(StoreRequestEnum::PreferredContact),
        );
    }
}
