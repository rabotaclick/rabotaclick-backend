<?php declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\DTO\Auth\AuthRequestDTO;
use App\Helpers\Contracts\RequestFilterHelperInterface;
use App\Http\Requests\Auth\Contracts\AuthRequestInterface;
use App\Http\Requests\Auth\Enums\AuthRequestEnum;
use App\Providers\Bindings\HelperServiceProvider;
use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest implements AuthRequestInterface
{
    public function rules(): array
    {
        return [
            AuthRequestEnum::Phone->value => 'required|string|max:32|regex:/^([0-9\s\-\+\(\)]*)$/|min:11'
        ];
    }

    public function getValidated(): AuthRequestDTO
    {
        $requestParams = $this->validated();

        $filter = resolve(RequestFilterHelperInterface::class, [
            HelperServiceProvider::PARAM_REQUEST_PARAMS => $requestParams,
        ]);

        return new AuthRequestDTO(
            normalizePhone($filter->checkRequestParam(AuthRequestEnum::Phone))
        );
    }
}
