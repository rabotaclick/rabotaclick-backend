<?php

namespace App\Http\Resources\Specialization;

use App\Http\Resources\Specialization\Enums\IndexResourceSubspecialization;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexResourceSubspecializations extends JsonResource
{
    public function toArray($request): array
    {
        return [
            IndexResourceSubspecialization::Id->value => $this->id,
            IndexResourceSubspecialization::Title->value => $this->title,
            IndexResourceSubspecialization::Vacancies->value => 0,
            IndexResourceSubspecialization::Subspecializations->value => $this->subspecializations->makeHidden(['specialization_id'])
        ];
    }
}
