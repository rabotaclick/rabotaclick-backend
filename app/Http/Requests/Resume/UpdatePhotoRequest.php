<?php

namespace App\Http\Requests\Resume;

use App\DTO\Resume\UpdatePhotoRequestDTO;
use App\Helpers\Contracts\RequestFilterHelperInterface;
use App\Http\Requests\Resume\Contracts\UpdatePhotoRequestInterface;
use App\Http\Requests\Resume\Enums\UpdatePhotoRequestEnum;
use App\Providers\Bindings\HelperServiceProvider;
use App\Rules\ImageUrlRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePhotoRequest extends FormRequest implements UpdatePhotoRequestInterface
{
    public function rules(): array
    {
        return [
            UpdatePhotoRequestEnum::Url->value => 'nullable|starts_with:https://cdn.rabotaclick.pro/|ends_with:.webp'
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
