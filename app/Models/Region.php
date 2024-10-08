<?php declare(strict_types=1);
namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Region extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'regions';

    protected $guarded = [
        'id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'country_id'
    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, "country_id", 'id');
    }

    public function cities(): HasMany
    {
        return $this->hasMany(City::class, 'region_id', 'id');
    }
}
