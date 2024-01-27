<?php

namespace App\Services;

use App\Jobs\Email\SendVerifyEmail;
use Illuminate\Support\Facades\Mail;

class MailService
{
    public function userChangeSend(string $token, string $email)
    {
        SendVerifyEmail::dispatch($token, $email)->onQueue('emails');
    }
}
