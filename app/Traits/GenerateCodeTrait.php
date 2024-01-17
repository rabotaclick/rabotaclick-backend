<?php

namespace App\Traits;

trait GenerateCodeTrait
{
    public function generateCode(): string
    {
        if(env('APP_ENV') == 'production') {
            $code = rand(0, 9999);
        } else {
            $code = 1111;
        }
        return hash_hmac('sha256',$code, env('APP_KEY'));
    }
}
