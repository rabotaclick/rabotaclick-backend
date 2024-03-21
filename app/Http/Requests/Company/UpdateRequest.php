<?php declare(strict_types=1);
namespace App\Http\Requests\Company;

use App\DTO\Company\UpdateRequestDTO;
use App\Helpers\Contracts\RequestFilterHelperInterface;
use App\Http\Requests\Company\Contracts\UpdateRequestInterface;
use App\Http\Requests\Company\Enums\UpdateRequestEnum;
use App\Models\City;
use App\Models\Specialization;
use App\Providers\Bindings\HelperServiceProvider;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest implements UpdateRequestInterface
{
    public function rules(): array
    {
        return [
            UpdateRequestEnum::Name->value => 'string|max:32',
            UpdateRequestEnum::CityId->value => 'uuid|exists:cities,id',
            UpdateRequestEnum::Website->value => 'url|max:128',
            UpdateRequestEnum::SpecializationId->value => 'uuid|exists:specializations,id',
            UpdateRequestEnum::Phone->value => 'string|max:32|regex:/^([0-9\s\-\+\(\)]*)$/|min:11',
            UpdateRequestEnum::Description->value => 'string|max:5000',
        ];
    }

    public function getValidated(): UpdateRequestDTO
    {
        $requestParams = $this->validated();

        $filter = resolve(RequestFilterHelperInterface::class, [
            HelperServiceProvider::PARAM_REQUEST_PARAMS => $requestParams,
        ]);

        return new UpdateRequestDTO(
            $filter->checkRequestParam(UpdateRequestEnum::Name),
            City::find($filter->checkRequestParam(UpdateRequestEnum::CityId)),
            $filter->checkRequestParam(UpdateRequestEnum::Website),
            Specialization::find($filter->checkRequestParam(UpdateRequestEnum::SpecializationId)),
            normalizePhone($filter->checkRequestParam(UpdateRequestEnum::Phone)),
            $filter->checkRequestParam(UpdateRequestEnum::Description),
        );
    }
}
