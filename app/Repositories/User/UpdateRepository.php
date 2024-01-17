<?php

namespace App\Repositories\User;

use App\DTO\User\UpdateRequestDTO;
use App\DTO\User\UserDTO;
use App\Models\User;
use App\Models\UserEmailChange;
use App\Repositories\User\Exceptions\UpdateRepositoryException;
use App\Services\MailService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UpdateRepository
{
    public function __construct(
        private User $user,
        private MailService $mailService,
    )
    {
    }
    public function make(UpdateRequestDTO $requestDTO): UserDTO
    {
        $this->user = Auth::user();
        DB::transaction(function () use($requestDTO){
            if(isset($requestDTO->change_email)) {
                if(
                    $this->user->email == $requestDTO->change_email ||
                    $this->user->change_email == $requestDTO->change_email
                ) {
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

        $this->mailService->userChangeSend($user_email_change->token, $change_email);
    }
}
