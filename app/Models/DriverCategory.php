<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverCategory extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'driver_categories';

    protected $guarded = [
        'id'
    ];
}
