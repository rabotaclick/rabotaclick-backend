<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResumePhoto extends Model
{
    use HasFactory, HasUuids;

    protected $table = "resume_photos";

    protected $guarded = [
        "id",
    ];

    public function resume(): BelongsTo
    {
        return $this->belongsTo(Resume::class, "resume_id", "id");
    }
}
