<?php declare(strict_types=1);

namespace App\Repositories\Auth;

use App\DTO\Auth\AuthRequestDTO;
use App\Models\UserAuth;
use App\Traits\GenerateCodeTrait;
use Illuminate\Support\Facades\Crypt;

class AuthRepository
{
    use GenerateCodeTrait;
    public function make(AuthRequestDTO $requestDTO): string
    {
        $userAuth = UserAuth::firstOrNew([
            'phone' => $requestDTO->phone
        ]);
        $userAuth->code_crypt = $this->generateCode();
        $userAuth->save();

        // TODO: implement sms service and transaction

        return $userAuth->phone;
    }
}
