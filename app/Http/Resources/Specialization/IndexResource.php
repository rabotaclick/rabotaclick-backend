<?php

namespace App\Http\Resources\Specialization;

use App\Http\Resources\Specialization\Enums\IndexResourceEnum;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            IndexResourceEnum::Title->value => $this->title,
            IndexResourceEnum::Vacancies->value => 0
        ];
    }
}
