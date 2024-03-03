<?php

namespace App\Http\Requests\Country;

use App\DTO\Country\IndexRequestDTO;
use App\Helpers\Contracts\RequestFilterHelperInterface;
use App\Http\Requests\Country\Contracts\IndexRequestInterface;
use App\Http\Requests\Country\Enums\IndexRequestEnum;
use App\Providers\Bindings\HelperServiceProvider;
use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest implements IndexRequestInterface
{
    public function rules(): array
    {
        return [
            IndexRequestEnum::Search->value => 'string|max:64'
        ];
    }

    public function getValidated(): IndexRequestDTO
    {
        $requestParams = $this->validated();

        $filter = resolve(RequestFilterHelperInterface::class, [
            HelperServiceProvider::PARAM_REQUEST_PARAMS => $requestParams,
        ]);

        return new IndexRequestDTO(
            $filter->checkRequestParam(IndexRequestEnum::Search)
        );
    }
}
