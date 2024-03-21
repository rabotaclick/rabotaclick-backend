<?php declare(strict_types=1);
namespace App\Http\Resources\Country;

use App\Http\Resources\Country\Enums\IndexResourceEnum;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            IndexResourceEnum::Id->value => $this->id,
            IndexResourceEnum::Name->value => $this->name,
        ];
    }
}
