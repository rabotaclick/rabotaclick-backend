<?php

namespace App\Http\Requests\UserEmployer;

use App\DTO\UserEmployer\UpdateRequestDTO;
use App\Helpers\Contracts\RequestFilterHelperInterface;
use App\Http\Requests\UserEmployer\Contracts\UpdateRequestInterface;
use App\Http\Requests\UserEmployer\Enums\UpdateRequestEnum;
use App\Providers\Bindings\HelperServiceProvider;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest implements UpdateRequestInterface
{
    public function rules(): array
    {
        return [
            UpdateRequestEnum::Name->value => 'string|max:32',
            UpdateRequestEnum::Surname->value => 'string|max:32',
            UpdateRequestEnum::Lastname->value => 'string|max:32',
            UpdateRequestEnum::Password->value => 'required_with:'. UpdateRequestEnum::NewPassword->value .'|string|min:8|max:32',
            UpdateRequestEnum::NewPassword->value => 'string|min:8|max:32',
        ];
    }

    public function getValidated(): UpdateRequestDTO
    {
        $requestParams = $this->validated();

        $filter = resolve(RequestFilterHelperInterface::class, [
            HelperServiceProvider::PARAM_REQUEST_PARAMS => $requestParams,
        ]);

        return new UpdateRequestDTO(
            $filter->checkRequestParam(UpdateRequestEnum::Name),
            $filter->checkRequestParam(UpdateRequestEnum::Surname),
            $filter->checkRequestParam(UpdateRequestEnum::Lastname),
            $filter->checkRequestParam(UpdateRequestEnum::Password),
            $filter->checkRequestParam(UpdateRequestEnum::NewPassword),
        );
    }
}
