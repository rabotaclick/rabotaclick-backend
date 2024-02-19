<?php

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
            ResourceEnum::IsVerified->value => $this->is_verified
        ];
    }
}
