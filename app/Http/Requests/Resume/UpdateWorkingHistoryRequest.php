<?php declare(strict_types=1);
namespace App\Http\Requests\Resume;

use App\DTO\Resume\UpdateWorkingHistoryRequestDTO;
use App\Helpers\Contracts\RequestFilterHelperInterface;
use App\Http\Requests\Resume\Contracts\UpdateWorkingHistoryRequestInterface;
use App\Http\Requests\Resume\Enums\UpdateWorkingHistoryRequestEnum;
use App\Providers\Bindings\HelperServiceProvider;
use Illuminate\Foundation\Http\FormRequest;

class UpdateWorkingHistoryRequest extends FormRequest implements UpdateWorkingHistoryRequestInterface
{
    public function rules(): array
    {
        return [
            UpdateWorkingHistoryRequestEnum::WorkHistories->value => 'array',
            UpdateWorkingHistoryRequestEnum::WorkHistories->value . '.create.*.start_date' => 'required|date_format:Y-m-d|before_or_equal:' . now()->format('Y-m-d'),
            UpdateWorkingHistoryRequestEnum::WorkHistories->value . '.create.*.end_date' => 'date_format:Y-m-d|before_or_equal:' . now()->format('Y-m-d'), // nullable
            UpdateWorkingHistoryRequestEnum::WorkHistories->value . '.create.*.organization' => 'required|string|max:128',
            UpdateWorkingHistoryRequestEnum::WorkHistories->value . '.create.*.region_id' => 'required|uuid|exists:regions,id',
            UpdateWorkingHistoryRequestEnum::WorkHistories->value . '.create.*.website_url' => 'url|max:255', // nullable
            UpdateWorkingHistoryRequestEnum::WorkHistories->value . '.create.*.subspecializations' => 'array', // nullable
            UpdateWorkingHistoryRequestEnum::WorkHistories->value . '.create.*.subspecializations.*' => 'required|uuid|exists:subspecializations,id',
            UpdateWorkingHistoryRequestEnum::WorkHistories->value . '.create.*.job' => 'required|string|max:128',
            UpdateWorkingHistoryRequestEnum::WorkHistories->value . '.create.*.description' => 'required|string|max:5000',

            UpdateWorkingHistoryRequestEnum::WorkHistories->value . '.delete.*' => 'uuid|exists:work_histories,id',

            UpdateWorkingHistoryRequestEnum::WorkHistories->value . '.update.*.id' => 'required|uuid|exists:work_histories,id',
            UpdateWorkingHistoryRequestEnum::WorkHistories->value . '.update.*.start_date' => 'date_format:Y-m-d|before_or_equal:' . now()->format('Y-m-d'),
            UpdateWorkingHistoryRequestEnum::WorkHistories->value . '.update.*.end_date' => 'date_format:Y-m-d|before_or_equal:' . now()->format('Y-m-d'), // nullable
            UpdateWorkingHistoryRequestEnum::WorkHistories->value . '.update.*.organization' => 'string|max:128',
            UpdateWorkingHistoryRequestEnum::WorkHistories->value . '.update.*.region_id' => 'uuid|exists:regions,id',
            UpdateWorkingHistoryRequestEnum::WorkHistories->value . '.update.*.website_url' => 'url|max:255', // nullable
            UpdateWorkingHistoryRequestEnum::WorkHistories->value . '.update.*.subspecializations' => 'array', // nullable
            UpdateWorkingHistoryRequestEnum::WorkHistories->value . '.update.*.subspecializations.*' => 'required|uuid|exists:subspecializations,id',
            UpdateWorkingHistoryRequestEnum::WorkHistories->value . '.update.*.job' => 'string|max:128',
            UpdateWorkingHistoryRequestEnum::WorkHistories->value . '.update.*.description' => 'string|max:5000',

            UpdateWorkingHistoryRequestEnum::KeySkills->value => 'array',
            UpdateWorkingHistoryRequestEnum::KeySkills->value . '.create.*' => 'uuid|exists:key_skills,id',
            UpdateWorkingHistoryRequestEnum::KeySkills->value . '.delete.*' => 'uuid|exists:key_skills,id',

            UpdateWorkingHistoryRequestEnum::AboutMe->value => 'string|max:5000',
            UpdateWorkingHistoryRequestEnum::HaveCar->value => 'boolean',

            UpdateWorkingHistoryRequestEnum::DriverCategories->value => 'array',
            UpdateWorkingHistoryRequestEnum::DriverCategories->value . ".*" => 'uuid|exists:driver_categories,id',
        ];
    }

    public function getValidated(): UpdateWorkingHistoryRequestDTO
    {
        $requestParams = $this->validated();

        $filter = resolve(RequestFilterHelperInterface::class, [
            HelperServiceProvider::PARAM_REQUEST_PARAMS => $requestParams,
        ]);

        return new UpdateWorkingHistoryRequestDTO(
            $filter->checkRequestParam(UpdateWorkingHistoryRequestEnum::WorkHistories),
            $filter->checkRequestParam(UpdateWorkingHistoryRequestEnum::KeySkills),
            $filter->checkRequestParam(UpdateWorkingHistoryRequestEnum::AboutMe),
            $filter->checkRequestParam(UpdateWorkingHistoryRequestEnum::HaveCar),
            $filter->checkRequestParam(UpdateWorkingHistoryRequestEnum::DriverCategories),
        );
    }
}
