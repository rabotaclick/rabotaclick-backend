<?php

namespace App\Http\Requests\Auth;

use App\DTO\Auth\LoginRequestDTO;
use App\Helpers\Contracts\RequestFilterHelperInterface;
use App\Http\Requests\Auth\Contracts\LoginRequestInterface;
use App\Http\Requests\Auth\Enums\LoginRequestEnum;
use App\Providers\Bindings\HelperServiceProvider;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest implements LoginRequestInterface
{
    public function rules(): array
    {
        return [
            LoginRequestEnum::Code->value => 'required|numeric|digits:4',
            LoginRequestEnum::Phone->value => 'required|string|max:32|regex:/^([0-9\s\-\+\(\)]*)$/|min:11',
        ];
    }

    public function getValidated(): LoginRequestDTO
    {
        $requestParams = $this->validated();

        $filter = resolve(RequestFilterHelperInterface::class, [
            HelperServiceProvider::PARAM_REQUEST_PARAMS => $requestParams,
        ]);

        return new LoginRequestDTO(
            $filter->checkRequestParam(LoginRequestEnum::Code),
            normalizePhone($filter->checkRequestParam(LoginRequestEnum::Phone)),
        );
    }
}
