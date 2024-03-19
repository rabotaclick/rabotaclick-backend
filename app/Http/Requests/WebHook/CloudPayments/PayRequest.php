<?php

namespace App\Http\Requests\WebHook\CloudPayments;

use App\DTO\WebHook\CloudPayments\PayRequestDTO;
use App\Helpers\Contracts\RequestFilterHelperInterface;
use App\Http\Requests\WebHook\CloudPayments\Contracts\PayRequestInterface;
use App\Http\Requests\WebHook\CloudPayments\Enums\PayRequestEnum;
use App\Providers\Bindings\HelperServiceProvider;
use Illuminate\Foundation\Http\FormRequest;

class PayRequest extends FormRequest implements PayRequestInterface
{
    public function rules(): array
    {
        return [
            PayRequestEnum::TransactionId->value => 'required'
        ];
    }

    public function getValidated(): PayRequestDTO
    {
        $requestParams = $this->validated();

        $filter = resolve(RequestFilterHelperInterface::class, [
            HelperServiceProvider::PARAM_REQUEST_PARAMS => $requestParams,
        ]);

        return new PayRequestDTO(
            $filter->checkRequestParam(PayRequestEnum::TransactionId)
        );
    }
}
