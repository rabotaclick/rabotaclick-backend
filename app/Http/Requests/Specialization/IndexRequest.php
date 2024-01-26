<?php

namespace App\Http\Requests\Specialization;

use App\DTO\Specialization\IndexRequestDTO;
use App\Helpers\Contracts\EnumHelperInterface;
use App\Helpers\Contracts\RequestFilterHelperInterface;
use App\Http\Requests\Enums\OrderByEnum;
use App\Http\Requests\Enums\PaginationRequestEnum;
use App\Http\Requests\Specialization\Contracts\IndexRequestInterface;
use App\Http\Requests\Specialization\Enums\IndexRequestEnum;
use App\Providers\Bindings\HelperServiceProvider;
use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest implements IndexRequestInterface
{
    public function rules(): array
    {
        $enumHelper = resolve(EnumHelperInterface::class);
        return [
            PaginationRequestEnum::First->value => 'required|numeric|max:100',
            PaginationRequestEnum::Page->value => 'numeric',
            IndexRequestEnum::OrderBy->value => 'string|in:' . $enumHelper->serialize(OrderByEnum::class),
            IndexRequestEnum::Column->value => 'string',
            IndexRequestEnum::WithSubspecializations->value => 'boolean'
        ];
    }

    public function getValidated(): IndexRequestDTO
    {
        $requestParams = $this->validated();

        $filter = resolve(RequestFilterHelperInterface::class, [
            HelperServiceProvider::PARAM_REQUEST_PARAMS => $requestParams,
        ]);

        return new IndexRequestDTO(
            $filter->checkRequestParam(PaginationRequestEnum::First),
            $filter->checkRequestParam(PaginationRequestEnum::Page) ?? 1,
            $filter->checkRequestParam(IndexRequestEnum::OrderBy) ?? OrderByEnum::ASC,
            $filter->checkRequestParam(IndexRequestEnum::Column) ?? "id",
            $filter->checkRequestParam(IndexRequestEnum::WithSubspecializations) ?? false,
        );
    }
}
