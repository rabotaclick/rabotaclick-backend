<?php

namespace App\Repositories\Auth;

use App\DTO\Auth\AuthRequestDTO;
use App\Models\UserAuth;
use Illuminate\Support\Facades\Crypt;

class AuthRepository
{
    public function make(AuthRequestDTO $requestDTO): string
    {
        $userAuth = UserAuth::firstOrNew([
            'phone' => $requestDTO->phone
        ]);
        $userAuth->code_crypt = $this->generateCode();
        $userAuth->save();

        return $userAuth->phone;
    }

    private function generateCode(): string
    {
        if(env('APP_ENV') == 'production') {
            while(true) {
                $code = rand(0, 9999);
                if(!UserAuth::where('code_crypt', '=',hash_hmac('sha256',$code, env('APP_KEY')))->exists()) {
                    break;
                }
            }
        } else {
            $code = 1111;
        }
        return hash_hmac('sha256',$code, env('APP_KEY'));
    }
}
