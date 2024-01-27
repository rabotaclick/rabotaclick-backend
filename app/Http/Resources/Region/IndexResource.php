<?php

namespace App\Http\Resources\Region;

use App\Http\Resources\Region\Enums\IndexResourceEnum;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            IndexResourceEnum::Id->value => $this->id,
            IndexResourceEnum::Name->value => $this->name,
            IndexResourceEnum::Country->value => $this->country,
        ];
    }
}
