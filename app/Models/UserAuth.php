<?php

namespace App\Models;

use App\Models\Exceptions\UserAuthFindCodeException;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class UserAuth extends Model
{
    use HasFactory, HasUuids;
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [
        'code_crypt'
    ];

    public static function findCode(string $phone, int $code): UserAuth
    {
        $encryptedCode = hash_hmac('sha256',$code, env('APP_KEY'));
        return UserAuth::where("code_crypt", "=", $encryptedCode)
            ->where("phone", "=", $phone)
            ->firstOrFail();
    }
}
