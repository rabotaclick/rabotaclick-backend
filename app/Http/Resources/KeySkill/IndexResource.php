<?php declare(strict_types=1);
namespace App\Http\Resources\KeySkill;

use App\Http\Resources\KeySkill\Enums\IndexResourceEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            IndexResourceEnum::Id->value => $this->id,
            IndexResourceEnum::Title->value => $this->title
        ];
    }
}
