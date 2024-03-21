<?php declare(strict_types=1);
namespace App\Http\Resources\Vacancy;

use App\Http\Resources\Vacancy\Enums\IndexResourceEnum;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            IndexResourceEnum::Id->value => $this->id,
            IndexResourceEnum::CreatedAt->value => $this->created_at,
            IndexResourceEnum::Company->value => $this->company()->with(['photo'])->first()->makeHidden([
                'city_id',
                'specialization_id',
                'created_at',
                'updated_at',
                'description',
                'is_verified',
                'document',
                'type',
                'phone'
            ]),
            IndexResourceEnum::Title->value => $this->title,
            IndexResourceEnum::SalaryFrom->value => $this->salary_from,
            IndexResourceEnum::SalaryTo->value => $this->salary_to,
            IndexResourceEnum::WorkExperience->value => $this->work_experience
        ];
    }
}
