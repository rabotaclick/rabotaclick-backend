<?php

namespace App\Http\Requests\User;

use App\DTO\User\UpdateRequestDTO;
use App\Helpers\Contracts\RequestFilterHelperInterface;
use App\Http\Requests\User\Contracts\UpdateRequestInterface;
use App\Http\Requests\User\Enums\UpdateRequestEnum;
use App\Providers\Bindings\HelperServiceProvider;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UpdateRequest extends FormRequest implements UpdateRequestInterface
{
    public function rules(): array
    {
        return [
            UpdateRequestEnum::Name->value => 'string|max:32',
            UpdateRequestEnum::Surname->value => 'string|max:32',
            UpdateRequestEnum::Lastname->value => 'string|max:32',
            UpdateRequestEnum::Password->value => 'string|min:8|max:32',
            UpdateRequestEnum::ChangeEmail->value => 'string|email|max:64',
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
            Hash::make($filter->checkRequestParam(UpdateRequestEnum::Password)),
            $filter->checkRequestParam(UpdateRequestEnum::ChangeEmail),
        );
    }
}
