<?php

namespace App\Http\Requests\Storage;

use App\DTO\Storage\PutManyRequestDTO;
use App\Helpers\Contracts\RequestFilterHelperInterface;
use App\Http\Requests\Storage\Contracts\PutRequestInterface;
use App\Http\Requests\Storage\Enums\PutRequestEnum;
use App\Providers\Bindings\HelperServiceProvider;
use Illuminate\Foundation\Http\FormRequest;

class PutRequest extends FormRequest implements PutRequestInterface
{
    public function rules(): array
    {
        return [
            PutRequestEnum::Files->value => 'required|array',
            PutRequestEnum::Files->value . ".*" => 'required|file|max:10000|mimes:jpeg,jpg,png,webp',
            ];
        }

    public function getValidated(): PutManyRequestDTO
    {
        $requestParams = $this->validated();

        $filter = resolve(RequestFilterHelperInterface::class, [
            HelperServiceProvider::PARAM_REQUEST_PARAMS => $requestParams,
        ]);

        return new PutManyRequestDTO(
            $filter->checkRequestParam(PutRequestEnum::Files)
        );
    }
}
