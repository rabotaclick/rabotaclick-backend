<?php declare(strict_types=1);
namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEmployerRegister extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'user_employer_registers';

    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [
        'password',
    ];
    protected $casts = [
        'password' => 'hashed'
    ];
}
