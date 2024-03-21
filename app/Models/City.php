<?php declare(strict_types=1);
namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class City extends Model
{
    use HasFactory, HasUuids;

    protected $table = "cities";

    protected $guarded = [
        'id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class, 'region_id', 'id');
    }
}
