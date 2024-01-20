<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'countries';

    protected $guarded = [
        'id'
    ];

    public function regions(): HasMany
    {
        return $this->hasMany(Region::class, 'country_id', 'id');
    }
}
