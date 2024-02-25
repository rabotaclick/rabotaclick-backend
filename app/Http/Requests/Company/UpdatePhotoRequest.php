<?php

namespace App\Http\Requests\Company;

use App\DTO\Company\UpdatePhotoRequestDTO;
use App\Helpers\Contracts\RequestFilterHelperInterface;
use App\Http\Requests\Company\Contracts\UpdatePhotoRequestInterface;
use App\Http\Requests\Company\Enums\UpdatePhotoRequestEnum;
use App\Providers\Bindings\HelperServiceProvider;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePhotoRequest extends FormRequest implements UpdatePhotoRequestInterface
{
    public function rules(): array
    {
        return [
            UpdatePhotoRequestEnum::Url->value => 'nullable|starts_with:https://cdn.rabotaclick.pro/photos'
        ];
    }

    public function getValidated(): UpdatePhotoRequestDTO
    {
        $requestParams = $this->validated();

        $filter = resolve(RequestFilterHelperInterface::class, [
            HelperServiceProvider::PARAM_REQUEST_PARAMS => $requestParams,
        ]);

        return new UpdatePhotoRequestDTO(
            $filter->checkRequestParam(UpdatePhotoRequestEnum::Url)
        );
    }
}
