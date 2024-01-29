<?php

namespace App\Http\Requests\Admin;

use App\DTO\Admin\AuthRequestDTO;
use App\Helpers\Contracts\RequestFilterHelperInterface;
use App\Http\Requests\Admin\Contracts\AuthRequestInterface;
use App\Http\Requests\Admin\Enums\AuthRequestEnum;
use App\Providers\Bindings\HelperServiceProvider;
use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest implements AuthRequestInterface
{
    public function rules(): array
    {
        return [
            AuthRequestEnum::Login->value => 'required|string|max:32',
            AuthRequestEnum::Password->value => 'required|string|min:8|max:32'
        ];
    }

    public function getValidated(): AuthRequestDTO
    {
        $requestParams = $this->validated();

        $filter = resolve(RequestFilterHelperInterface::class, [
            HelperServiceProvider::PARAM_REQUEST_PARAMS => $requestParams,
        ]);

        return new AuthRequestDTO(
            $filter->checkRequestParam(AuthRequestEnum::Login),
            $filter->checkRequestParam(AuthRequestEnum::Password),
        );
    }
}
