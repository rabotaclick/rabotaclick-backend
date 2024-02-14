<?php

namespace App\Repositories\Email\Employer;

use App\Models\UserEmployer;
use App\Models\UserEmployerRegister;
use Illuminate\Support\Facades\DB;

class VerifyRepository
{
    public function __construct(
        private UserEmployer $userEmployer
    )
    {
    }

    public function make(string $token): string
    {
        DB::transaction(function() use($token) {
            $user_employer_register = UserEmployerRegister::where("token", "=", $token)->firstOrFail();

            $this->userEmployer = new UserEmployer();
            $this->userEmployer->email = $user_employer_register->email;
            $this->userEmployer->password = $user_employer_register->password;
            $this->userEmployer->save();

            $user_employer_register->delete();
        });

        return $this->userEmployer->createToken('auth-token')->plainTextToken;
    }
}
