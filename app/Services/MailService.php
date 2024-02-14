<?php

namespace App\Services;

use App\Jobs\Email\SendRegisterEmail;
use App\Jobs\Email\SendVerifyEmail;
use Illuminate\Support\Facades\Mail;

class MailService
{
    public function userChangeSend(string $token, string $email)
    {
        SendVerifyEmail::dispatch($token, $email)->onQueue('emails');
    }

    public function userEmployerRegister(string $token, string $email)
    {
        SendRegisterEmail::dispatch($token, $email)->onQueue('emails');
    }
}
