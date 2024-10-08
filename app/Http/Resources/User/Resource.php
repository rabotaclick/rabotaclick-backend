<?php declare(strict_types=1);
namespace App\Http\Resources\User;

use App\Http\Resources\User\Enums\ResourceEnum;
use Illuminate\Http\Resources\Json\JsonResource;

class Resource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            ResourceEnum::Id->value => $this->id,
            ResourceEnum::Name->value => $this->name,
            ResourceEnum::Surname->value => $this->surname,
            ResourceEnum::Lastname->value => $this->lastname,
            ResourceEnum::Status->value => $this->status,
            ResourceEnum::Phone->value => $this->phone,
            ResourceEnum::Email->value => $this->email,
            ResourceEnum::ChangeEmail->value => $this->change_email,
            ResourceEnum::ChangePhone->value => $this->change_phone,
            ResourceEnum::HasPassword->value => $this->has_password,
            ResourceEnum::CreatedAt->value => $this->created_at->format('Y-m-d H:i:s'),
            ResourceEnum::UpdatedAt->value => $this->updated_at->format('Y-m-d H:i:s'),
            ResourceEnum::Resumes->value => $this->resumes()
                ->select(['id','updated_at','profession'])
                ->get()
                ->makeHidden(['work_histories'])
        ];
    }
}
