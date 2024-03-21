<?php declare(strict_types=1);

namespace App\Http\Requests\Auth\Employer;

use App\DTO\Auth\Employer\FinishRegisterRequestDTO;
use App\Helpers\Contracts\RequestFilterHelperInterface;
use App\Http\Requests\Auth\Employer\Contracts\FinishRegisterRequestInterface;
use App\Http\Requests\Auth\Employer\Enums\FinishRegisterRequestEnum;
use App\Providers\Bindings\HelperServiceProvider;
use Illuminate\Foundation\Http\FormRequest;

class FinishRegisterRequest extends FormRequest implements FinishRegisterRequestInterface
{
    public function rules(): array
    {
        return [
            FinishRegisterRequestEnum::Name->value => 'required|string|max:32',
            FinishRegisterRequestEnum::Surname->value => 'required|string|max:32'
        ];
    }

    public function getValidated(): FinishRegisterRequestDTO
    {
        $requestParams = $this->validated();

        $filter = resolve(RequestFilterHelperInterface::class, [
            HelperServiceProvider::PARAM_REQUEST_PARAMS => $requestParams,
        ]);

        return new FinishRegisterRequestDTO(
            $filter->checkRequestParam(FinishRegisterRequestEnum::Name),
            $filter->checkRequestParam(FinishRegisterRequestEnum::Surname)
        );
    }
}
