<?php declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\DTO\Auth\LoginPasswordDTO;
use App\Helpers\Contracts\RequestFilterHelperInterface;
use App\Http\Requests\Auth\Contracts\LoginPasswordRequestInterface;
use App\Http\Requests\Auth\Enums\LoginPasswordRequestEnum;
use App\Providers\Bindings\HelperServiceProvider;
use App\Rules\PhoneOrEmailRule;
use Illuminate\Foundation\Http\FormRequest;

class LoginPasswordRequest extends FormRequest implements LoginPasswordRequestInterface
{
    public function rules(): array
    {
        return [
            LoginPasswordRequestEnum::Login->value => [new PhoneOrEmailRule()],
            LoginPasswordRequestEnum::Password->value => 'string|min:8|max:32',
        ];
    }

    public function getValidated(): LoginPasswordDTO
    {
        $requestParams = $this->validated();

        $filter = resolve(RequestFilterHelperInterface::class, [
            HelperServiceProvider::PARAM_REQUEST_PARAMS => $requestParams,
        ]);

        return new LoginPasswordDTO(
            $this->normalizePhoneOrEmail($filter->checkRequestParam(LoginPasswordRequestEnum::Login)),
            $filter->checkRequestParam(LoginPasswordRequestEnum::Password),
        );
    }

    private function normalizePhoneOrEmail(string $login)
    {
        if(filter_var($login, FILTER_VALIDATE_EMAIL)){
            return $login;
        } else {
            return normalizePhone($login);
        }
    }
}
