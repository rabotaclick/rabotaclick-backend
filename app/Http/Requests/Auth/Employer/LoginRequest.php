<?php declare(strict_types=1);

namespace App\Http\Requests\Auth\Employer;

use App\DTO\Auth\Employer\LoginRequestDTO;
use App\Helpers\Contracts\RequestFilterHelperInterface;
use App\Http\Requests\Auth\Employer\Contracts\LoginRequestInterface;
use App\Http\Requests\Auth\Employer\Enums\LoginRequestEnum;
use App\Providers\Bindings\HelperServiceProvider;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest implements LoginRequestInterface
{
    public function rules(): array
    {
        return [
            LoginRequestEnum::Email->value => 'required|email|max:128',
            LoginRequestEnum::Password->value => 'required|string|min:8|max:32'
        ];
    }

    public function getValidated(): LoginRequestDTO
    {
        $requestParams = $this->validated();

        $filter = resolve(RequestFilterHelperInterface::class, [
            HelperServiceProvider::PARAM_REQUEST_PARAMS => $requestParams,
        ]);

        return new LoginRequestDTO(
            $filter->checkRequestParam(LoginRequestEnum::Email),
            $filter->checkRequestParam(LoginRequestEnum::Password)
        );
    }
}
