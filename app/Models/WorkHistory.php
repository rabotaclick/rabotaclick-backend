<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class WorkHistory extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'work_histories';

    protected $guarded = [
        'id'
    ];

    public function resume(): BelongsTo
    {
        return $this->belongsTo(Resume::class, 'resume_id', 'id');
    }

    public function subspecializations(): BelongsToMany
    {
        return $this->belongsToMany(Subspecialization::class, 'work_history_subspecializations');
    }
}
