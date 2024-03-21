<?php declare(strict_types=1);

namespace App\Http\Requests\Auth\Employer;

use App\DTO\Auth\Employer\RegisterRequestDTO;
use App\Helpers\Contracts\RequestFilterHelperInterface;
use App\Http\Requests\Auth\Employer\Contracts\RegisterRequestInterface;
use App\Http\Requests\Auth\Employer\Enums\RegisterRequestEnum;
use App\Providers\Bindings\HelperServiceProvider;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest implements RegisterRequestInterface
{
    public function rules(): array
    {
        return [
            RegisterRequestEnum::Email->value => 'required|email|max:128|unique:user_employers,email',
            RegisterRequestEnum::Password->value => 'required|string|min:8|max:32'
        ];
    }

    public function getValidated(): RegisterRequestDTO
    {
        $requestParams = $this->validated();

        $filter = resolve(RequestFilterHelperInterface::class, [
            HelperServiceProvider::PARAM_REQUEST_PARAMS => $requestParams,
        ]);

        return new RegisterRequestDTO(
            $filter->checkRequestParam(RegisterRequestEnum::Email),
            $filter->checkRequestParam(RegisterRequestEnum::Password)
        );
    }
}
