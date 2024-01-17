<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserPhoneChange extends Model
{
    use HasFactory, HasUuids;

    protected $table = "user_phone_changes";

    protected $guarded = [
        "id",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }

    public static function findCode(string $user_id, int $code): UserPhoneChange
    {
        $encryptedCode = hash_hmac('sha256',$code, env('APP_KEY'));
        return UserPhoneChange::where("code_crypt", "=", $encryptedCode)
            ->where("user_id", "=", $user_id)
            ->firstOrFail();
    }
}
