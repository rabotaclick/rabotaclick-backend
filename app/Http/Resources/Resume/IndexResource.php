<?php declare(strict_types=1);
namespace App\Http\Resources\Resume;

use App\Http\Resources\Resume\Enums\IndexResourceEnum;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            IndexResourceEnum::Id->value => $this->id,
            IndexResourceEnum::Profession->value => $this->profession,
            IndexResourceEnum::Birthdate->value => $this->birthdate,
            IndexResourceEnum::UpdatedAt->value => $this->updated_at,
            IndexResourceEnum::Salary->value => $this->salary,
            IndexResourceEnum::User->value => $this->user()
                ->select(['status'])
                ->first()
                ->makeHidden(['has_password']),
            IndexResourceEnum::WorkExperience->value => $this->work_experience,
            IndexResourceEnum::LastWork->value => $this->last_work
        ];
    }
}
