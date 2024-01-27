<?php

namespace App\Http\Resources\Language;

use App\Http\Resources\Language\Enums\IndexResourceEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            IndexResourceEnum::Id->value => $this->id,
            IndexResourceEnum::Name->value =>  $this->name,
        ];
    }
}
