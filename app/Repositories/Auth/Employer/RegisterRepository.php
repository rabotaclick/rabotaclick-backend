<?php

namespace App\Repositories\Auth\Employer;

use App\DTO\Auth\Employer\RegisterRequestDTO;
use App\Models\UserEmployerRegister;
use App\Services\MailService;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterRepository
{
    public function __construct(
        private MailService $mailService,
    )
    {
    }

    public function make(RegisterRequestDTO $requestDTO): string
    {
        $user_employer_register = DB::transaction(function () use($requestDTO) {
            $user_employer_register = new UserEmployerRegister();
            $user_employer_register->email = $requestDTO->email;
            $user_employer_register->password = Hash::make($requestDTO->password);
            $user_employer_register->token = Crypt::encrypt($requestDTO->email);
            $user_employer_register->save();

            $this->sendEmail($user_employer_register);

            return $user_employer_register;
        });
        return $user_employer_register->email;
    }

    private function sendEmail(UserEmployerRegister $user_employer_register)
    {
        if(env('APP_ENV') != "testing") {
            $this->mailService->userEmployerRegister($user_employer_register->token, $user_employer_register->email);
        }
    }
}
