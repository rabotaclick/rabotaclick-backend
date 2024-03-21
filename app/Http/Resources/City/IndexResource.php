<?php declare(strict_types=1);
namespace App\Http\Resources\City;

use App\Http\Resources\City\Enums\IndexResourceEnum;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            IndexResourceEnum::Id->value => $this->id,
            IndexResourceEnum::Name->value => $this->name,
            IndexResourceEnum::Region->value => $this->region()->with(['country'])->first(),
        ];
    }
}
