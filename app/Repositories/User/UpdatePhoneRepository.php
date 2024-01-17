<?php

namespace App\Repositories\User;

use App\DTO\User\UpdatePhoneRequestDTO;
use App\DTO\User\UserDTO;
use App\Models\User;
use App\Models\UserPhoneChange;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UpdatePhoneRepository
{
    public function __construct(
        private User $user
    )
    {
    }

    public function make(UpdatePhoneRequestDTO $requestDTO): UserDTO
    {
        $this->user = Auth::user();
        DB::transaction(function() use($requestDTO) {
            $user_phone_change = UserPhoneChange::findCode($this->user->id, $requestDTO->code);
            $this->user->phone = $this->user->change_phone;
            $this->user->change_phone = null;
            $this->user->save();
            $user_phone_change->delete();
        });
        return new UserDTO($this->user);
    }
}
