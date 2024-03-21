<?php declare(strict_types=1);
namespace App\Http\Requests\Resume;

use App\DTO\Resume\UpdatePersonalRequestDTO;
use App\Helpers\Contracts\EnumHelperInterface;
use App\Helpers\Contracts\RequestFilterHelperInterface;
use App\Http\Requests\Resume\Contracts\UpdatePersonalRequestInterface;
use App\Http\Requests\Resume\Enums\ResumeBusinessTripsEnum;
use App\Http\Requests\Resume\Enums\ResumeGenderEnum;
use App\Http\Requests\Resume\Enums\ResumeReadyToMoveEnum;
use App\Http\Requests\Resume\Enums\StoreRequestEnum;
use App\Http\Requests\Resume\Enums\UpdatePersonalRequestEnum;
use App\Models\City;
use App\Models\Country;
use App\Providers\Bindings\HelperServiceProvider;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePersonalRequest extends FormRequest implements UpdatePersonalRequestInterface
{
    public function rules(): array
    {
        $enumHelper = resolve(EnumHelperInterface::class);
        return [
            UpdatePersonalRequestEnum::Name->value => 'string|max:32',
            UpdatePersonalRequestEnum::Surname->value => 'string|max:32',
            UpdatePersonalRequestEnum::Lastname->value => 'string|max:32',
            UpdatePersonalRequestEnum::Birthdate->value => 'date_format:Y-m-d|before_or_equal:'. now()->subYears(14)->format('Y-m-d'),
            UpdatePersonalRequestEnum::Gender->value => 'in:' . $enumHelper->serialize(ResumeGenderEnum::class),
            UpdatePersonalRequestEnum::CityId->value => 'uuid|exists:cities,id',
            UpdatePersonalRequestEnum::ReadyToMove->value => 'in:' . $enumHelper->serialize(ResumeReadyToMoveEnum::class),
            UpdatePersonalRequestEnum::BusinessTrips->value => 'in:' . $enumHelper->serialize(ResumeBusinessTripsEnum::class),
            UpdatePersonalRequestEnum::CitizenshipCountryId->value => 'uuid|exists:countries,id',
            UpdatePersonalRequestEnum::WorkPermitCountryId->value => 'uuid|exists:countries,id',
        ];
    }

    public function getValidated(): UpdatePersonalRequestDTO
    {
        $requestParams = $this->validated();

        $filter = resolve(RequestFilterHelperInterface::class, [
            HelperServiceProvider::PARAM_REQUEST_PARAMS => $requestParams,
        ]);

        return new UpdatePersonalRequestDTO(
            $filter->checkRequestParam(StoreRequestEnum::Surname),
            $filter->checkRequestParam(StoreRequestEnum::Name),
            $filter->checkRequestParam(StoreRequestEnum::Lastname),
            Carbon::parse($filter->checkRequestParam(StoreRequestEnum::Birthdate)),
            $filter->checkRequestParam(StoreRequestEnum::Gender),
            City::find($filter->checkRequestParam(StoreRequestEnum::CityId)),
            $filter->checkRequestParam(StoreRequestEnum::ReadyToMove),
            $filter->checkRequestParam(StoreRequestEnum::BusinessTrips),
            Country::find($filter->checkRequestParam(StoreRequestEnum::CitizenshipCountryId)),
            Country::find($filter->checkRequestParam(StoreRequestEnum::WorkPermitCountryId)),
        );
    }
}
