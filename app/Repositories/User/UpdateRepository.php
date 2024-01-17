<?php

namespace App\Repositories\User;

use App\DTO\User\UpdateRequestDTO;
use App\DTO\User\UserDTO;
use App\Models\User;
use App\Models\UserEmailChange;
use App\Repositories\User\Exceptions\UpdateRepositoryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UpdateRepository
{
    public function __construct(
        private User $user
    )
    {
    }
    public function make(UpdateRequestDTO $requestDTO): UserDTO
    {
        $this->user = Auth::user();
        DB::transaction(function () use($requestDTO){
            if(isset($requestDTO->change_email)) {
                if($this->user->email == $requestDTO->change_email) {
                    throw new UpdateRepositoryException();
                }
                $this->changeEmail($requestDTO->change_email);
            }
            $this->user->update($requestDTO->toArray());
        });

        return new UserDTO(
            $this->user
        );
    }

    private function changeEmail($change_email)
    {
        $user_email_change = UserEmailChange::firstOrNew(["user_id" => $this->user->id]);
        $user_email_change->token = Crypt::encrypt($change_email);
        $user_email_change->save();

        Mail::send('mails.change_email', ['token' => $user_email_change->token], function ($message) use($change_email) {
            $message->to($change_email);
            $message->subject('Смена почты Работа клик');
        });
    }
}
