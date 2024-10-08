<?php declare(strict_types=1);
namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EducationPlace extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'education_places';

    protected $guarded = [
        'id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    public function resume(): BelongsTo
    {
        return $this->belongsTo(Resume::class, 'resume_id', 'id');
    }
}
