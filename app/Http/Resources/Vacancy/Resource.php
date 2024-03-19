<?php

namespace App\Http\Resources\Vacancy;

use App\Http\Resources\Vacancy\Enums\ResourceEnum;
use Illuminate\Http\Resources\Json\JsonResource;

class Resource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            ResourceEnum::Id->value => $this->id,
            ResourceEnum::CreatedAt->value => $this->created_at,
            ResourceEnum::UpdatedAt->value => $this->updated_at,
            ResourceEnum::Title->value => $this->title,
            ResourceEnum::SalaryType->value => $this->salary_type,
            ResourceEnum::SalaryFrom->value => $this->salary_from,
            ResourceEnum::SalaryTo->value => $this->salary_to,
            ResourceEnum::WorkExperience->value => $this->work_experience,
            ResourceEnum::Occupation->value => $this->occupation,
            ResourceEnum::GPC->value => $this->gpc,
            ResourceEnum::WorkType->value => $this->work_type,
            ResourceEnum::Schedule->value => $this->schedule,
            ResourceEnum::Subspecializations->value => $this->subspecializations->makeHidden(['pivot']),
            ResourceEnum::KeySkills->value => $this->key_skills->makeHidden(['pivot']),
            ResourceEnum::City->value => $this->city,
            ResourceEnum::Responsibilities->value => $this->responsibilities,
            ResourceEnum::Requirements->value => $this->requirements,
            ResourceEnum::Conditions->value => $this->conditions,
            ResourceEnum::Education->value => $this->education,
            ResourceEnum::ContactName->value => $this->contact_name,
            ResourceEnum::ContactSurname->value => $this->contact_surname,
            ResourceEnum::ContactLastname->value => $this->contact_lastname,
            ResourceEnum::ContactPhone->value => $this->contact_phone,
            ResourceEnum::ContactEmail->value => $this->contact_email,
            ResourceEnum::Letter->value => $this->letter,
            ResourceEnum::Type->value => $this->type,
            ResourceEnum::Company->value => $this->company
        ];
    }
}
