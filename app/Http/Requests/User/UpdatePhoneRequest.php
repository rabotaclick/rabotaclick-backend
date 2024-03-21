<?php declare(strict_types=1);

namespace App\Http\Requests\User;

use App\DTO\User\UpdatePhoneRequestDTO;
use App\Helpers\Contracts\RequestFilterHelperInterface;
use App\Http\Requests\User\Contracts\UpdatePhoneRequestInterface;
use App\Http\Requests\User\Enums\UpdatePhoneRequestEnum;
use App\Providers\Bindings\HelperServiceProvider;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePhoneRequest extends FormRequest implements UpdatePhoneRequestInterface
{
    public function rules(): array
    {
        return [
            UpdatePhoneRequestEnum::Code->value => 'required|digits:4'
        ];
    }

    public function getValidated(): UpdatePhoneRequestDTO
    {
        $requestParams = $this->validated();

        $filter = resolve(RequestFilterHelperInterface::class, [
            HelperServiceProvider::PARAM_REQUEST_PARAMS => $requestParams,
        ]);

        return new UpdatePhoneRequestDTO(
            $filter->checkRequestParam(UpdatePhoneRequestEnum::Code)
        );
    }
}
