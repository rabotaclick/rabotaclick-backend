<?php declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\DTO\Auth\LoginRequestDTO;
use App\DTO\Auth\RegisterRequestDTO;
use App\Helpers\Contracts\RequestFilterHelperInterface;
use App\Http\Requests\Auth\Contracts\RegisterRequestInterface;
use App\Http\Requests\Auth\Enums\LoginRequestEnum;
use App\Http\Requests\Auth\Enums\RegisterRequestEnum;
use App\Providers\Bindings\HelperServiceProvider;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest implements RegisterRequestInterface
{
    public function rules(): array
    {
        return [
            RegisterRequestEnum::Name->value => 'required|string|max:32',
            RegisterRequestEnum::Surname->value => 'required|string|max:32'
        ];
    }

    public function getValidated(): RegisterRequestDTO
    {
        $requestParams = $this->validated();

        $filter = resolve(RequestFilterHelperInterface::class, [
            HelperServiceProvider::PARAM_REQUEST_PARAMS => $requestParams,
        ]);

        return new RegisterRequestDTO(
            $filter->checkRequestParam(RegisterRequestEnum::Name),
            $filter->checkRequestParam(RegisterRequestEnum::Surname),
        );
    }
}
