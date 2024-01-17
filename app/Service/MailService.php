<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;

class MailService
{
    public function userChangeSend(string $token, string $email)
    {
        Mail::send('mails.change_email', ['token' => $token], function ($message) use($email) {
            $message->to($email);
            $message->subject('Смена почты Работа клик');
        });
    }
}
