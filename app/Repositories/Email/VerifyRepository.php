<?php

namespace App\Repositories\Email;

use App\Models\User;
use App\Models\UserEmailChange;
use Illuminate\Support\Facades\DB;

class VerifyRepository
{
    public function __construct(
        private User $user
    )
    {
    }

    public function make(string $token): string
    {
        DB::transaction(function() use($token) {
            $user_change_email = UserEmailChange::where("token", "=", $token)->firstOrFail();

            $this->user = $user_change_email->user;
            $this->user->email = $this->user->change_email;
            $this->user->change_email = null;
            $this->user->save();

            $user_change_email->delete();
        });

        return $this->user->email;
    }
}
