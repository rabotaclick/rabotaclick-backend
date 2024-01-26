<?php

namespace App\Http\Resources\SubSpecialization;

use App\Http\Resources\SubSpecialization\Enums\IndexResourceEnum;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            IndexResourceEnum::Id->value => $this->id,
            IndexResourceEnum::Title->value => $this->title,
            IndexResourceEnum::Specializaton->value => $this->specialization->makeHidden(['created_at','updated_at'])
        ];
    }
}
