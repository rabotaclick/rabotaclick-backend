<?php

namespace App\Http\Requests\WebHook\CloudPayments;

use App\DTO\WebHook\CloudPayments\CheckRequestDTO;
use App\Helpers\Contracts\RequestFilterHelperInterface;
use App\Http\Requests\WebHook\CloudPayments\Contracts\CheckRequestInterface;
use App\Http\Requests\WebHook\CloudPayments\Enums\CheckRequestEnum;
use App\Providers\Bindings\HelperServiceProvider;
use Illuminate\Foundation\Http\FormRequest;

class CheckRequest extends FormRequest implements CheckRequestInterface
{
    public function rules(): array
    {
        return [
            CheckRequestEnum::InvoiceId->value => 'required',
            CheckRequestEnum::AccountId->value => 'required',
            CheckRequestEnum::DateTime->value => 'required',
            CheckRequestEnum::Amount->value => 'required',
            CheckRequestEnum::TransactionId->value => 'required',
        ];
    }

    public function getValidated(): CheckRequestDTO
    {
        $requestParams = $this->validated();

        $filter = resolve(RequestFilterHelperInterface::class, [
            HelperServiceProvider::PARAM_REQUEST_PARAMS => $requestParams,
        ]);

        return new CheckRequestDTO(
            $filter->checkRequestParam(CheckRequestEnum::InvoiceId),
            $filter->checkRequestParam(CheckRequestEnum::AccountId),
            $filter->checkRequestParam(CheckRequestEnum::DateTime),
            intval($filter->checkRequestParam(CheckRequestEnum::Amount)),
            $filter->checkRequestParam(CheckRequestEnum::TransactionId)
        );
    }
}
