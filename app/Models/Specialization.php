<?php declare(strict_types=1);
namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Specialization extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'specializations';

    protected $guarded = [
        'id'
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    public function subspecializations(): HasMany
    {
        return $this->hasMany(Subspecialization::class, 'specialization_id', 'id');
    }
}
