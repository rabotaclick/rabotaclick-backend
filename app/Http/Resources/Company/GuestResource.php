<?php

namespace App\Http\Resources\Company;

use App\Http\Resources\Company\Enums\GuestResourceEnum;
use Illuminate\Http\Resources\Json\JsonResource;

class GuestResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            GuestResourceEnum::Id->value => $this->id,
            GuestResourceEnum::Type->value => $this->type,
            GuestResourceEnum::Name->value => $this->name,
            GuestResourceEnum::Website->value => $this->website,
            GuestResourceEnum::Description->value => $this->description,
            GuestResourceEnum::City->value => $this->city,
            GuestResourceEnum::Specialization->value => $this->specialization,
            GuestResourceEnum::Photo->value => $this->photo
        ];
    }
}
