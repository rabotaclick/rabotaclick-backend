<?php

namespace App\Repositories\User;

use App\DTO\User\UpdateRequestDTO;
use App\DTO\User\UserDTO;
use App\Models\User;
use App\Models\UserEmailChange;
use App\Models\UserPhoneChange;
use App\Repositories\User\Exceptions\InvalidEmailException;
use App\Repositories\User\Exceptions\InvalidPhoneException;
use App\Services\MailService;
use App\Traits\GenerateCodeTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class UpdateRepository
{
    use GenerateCodeTrait;
    public function __construct(
        private User        $user,
        private MailService $mailService,
    )
    {
    }

    public function make(UpdateRequestDTO $requestDTO): UserDTO
    {
        $this->user = Auth::user();
        DB::transaction(function () use ($requestDTO) {
            if (isset($requestDTO->change_email)) {
                $this->checkEmail($requestDTO->change_email);
                $this->changeEmail($requestDTO->change_email);
            }

            if (isset($requestDTO->change_phone)) {
                $this->checkPhone($requestDTO->change_phone);
                $this->changePhone();
            }

            $this->user->update($requestDTO->toArray());
        });

        return new UserDTO(
            $this->user
        );
    }

    private function changeEmail($change_email)
    {
        $user_email_change = UserEmailChange::firstOrNew(['user_id' => $this->user->id]);
        $user_email_change->token = Crypt::encrypt($change_email);
        $user_email_change->save();

        $this->mailService->userChangeSend($user_email_change->token, $change_email);
    }

    private function changePhone()
    {
        $user_phone_change = UserPhoneChange::firstOrNew(['user_id' => $this->user->id]);
        $user_phone_change->code_crypt = $this->generateCode();
        $user_phone_change->save();

        // TODO: implement sms service and transaction
    }

    private function checkPhone($change_phone)
    {
        if (
            $this->user->phone == $change_phone ||
            $this->user->change_phone == $change_phone
        ) {
            throw new InvalidPhoneException();
        }
    }

    private function checkEmail($change_email)
    {
        if (
            $this->user->email == $change_email ||
            $this->user->change_email == $change_email
        ) {
            throw new InvalidEmailException();
        }
    }
}
