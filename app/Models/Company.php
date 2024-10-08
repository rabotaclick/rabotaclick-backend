<?php declare(strict_types=1);
namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Company extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'companies';

    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    protected $appends = [
        'is_verified'
    ];

    public function document(): HasOne
    {
        return $this->hasOne(CompanyDocument::class, 'company_id', 'id');
    }
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }
    public function specialization(): BelongsTo
    {
        return $this->belongsTo(Specialization::class, 'specialization_id', 'id');
    }
    public function getIsVerifiedAttribute(): bool
    {
        return $this->document->is_verfied ?? false;
    }

    public function photo(): HasOne
    {
        return $this->hasOne(CompanyPhoto::class, 'company_id', 'id');
    }

    public function vacancies(): HasMany
    {
        return $this->hasMany(Vacancy::class, 'company_id', 'id');
    }

    public function user_employer(): HasOne
    {
        return $this->hasOne(UserEmployer::class, 'company_id', 'id');
    }
}
