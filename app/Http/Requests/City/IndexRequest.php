<?php declare(strict_types=1);

namespace App\Http\Requests\City;

use App\DTO\City\IndexRequestDTO;
use App\Helpers\Contracts\RequestFilterHelperInterface;
use App\Http\Requests\City\Contracts\IndexRequestInterface;
use App\Http\Requests\City\Enums\IndexRequestEnum;
use App\Http\Requests\Enums\PaginationRequestEnum;
use App\Providers\Bindings\HelperServiceProvider;
use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest implements IndexRequestInterface
{
    public function rules(): array
    {
        return [
            PaginationRequestEnum::First->value => 'required|integer|max:100',
            PaginationRequestEnum::Page->value => 'integer',
            IndexRequestEnum::Letter->value => 'string|min:1|max:1',
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
            intval($filter->checkRequestParam(PaginationRequestEnum::First)),
            $filter->checkRequestParam(PaginationRequestEnum::Page) ?? 1,
            $filter->checkRequestParam(IndexRequestEnum::Search),
            $filter->checkRequestParam(IndexRequestEnum::Letter),
        );
    }
}
