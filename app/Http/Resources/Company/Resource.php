<?php declare(strict_types=1);
namespace App\Http\Resources\Company;

use App\Http\Resources\Company\Enums\ResourceEnum;
use Illuminate\Http\Resources\Json\JsonResource;

class Resource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            ResourceEnum::Id->value => $this->id,
            ResourceEnum::CreatedAt->value => $this->created_at->format('Y-m-d H:i:s'),
            ResourceEnum::UpdatedAt->value => $this->updated_at->format('Y-m-d H:i:s'),
            ResourceEnum::Type->value => $this->type,
            ResourceEnum::Name->value => $this->name,
            ResourceEnum::Website->value => $this->website,
            ResourceEnum::Phone->value => $this->phone,
            ResourceEnum::Description->value => $this->description,
            ResourceEnum::City->value => $this->city,
            ResourceEnum::Specialization->value => $this->specialization,
            ResourceEnum::IsVerified->value => $this->is_verified,
            ResourceEnum::Photo->value => $this->photo,
            ResourceEnum::Vacancies->value => $this->vacancies->makeHidden([
                'salary_from',
                'salary_to',
                'gpc',
                'responsibilities',
                'requirements',
                'conditions',
                'salary_type',
                'education',
                'contact_name',
                'contact_surname',
                'contact_lastname',
                'contact_phone',
                'contact_email',
                'letter',
                'city_id',
                'company_id',
                'payments'
            ])

        ];
    }
}
