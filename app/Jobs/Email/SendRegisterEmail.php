<?php

namespace App\Jobs\Email;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendRegisterEmail
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private string $token,
        private string $email,
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $email = $this->email;
        Mail::send('mails.user_employer_register_email', ['token' => $this->token], function ($message) use($email) {
            $message->to($email);
            $message->subject('Регистрация на платформе Работа Клик');
        });
    }
}
