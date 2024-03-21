<?php declare(strict_types=1);
namespace App\Models;

use App\Custom\Scout\ExtendedSearchable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vacancy extends Model
{
    use HasFactory, HasUuids, ExtendedSearchable;

    public function searchableAs(): string
    {
        return 'vacancies_index';
    }

    public function toSearchableArray(): array
    {
        $array = [
            'title' => $this->title,
            'requirements' => $this->requirements,
            'responsibilities' => $this->responsibilities,
            'conditions' => $this->conditions,
            'education' => $this->education,
            'occupation' => $this->occupation,
            'schedule' => $this->schedule,
            'work_experience' => $this->work_experience,
            'is_active' => $this->is_active,
            'city_id' => $this->city_id,
            'type' => (string) $this->getTypeAttribute(),
        ];
        return $array;
    }

    protected $table = 'vacancies';

    protected $guarded = [
        'id'
    ];

    protected $appends = [
        'type'
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function subspecializations(): BelongsToMany
    {
        return $this->belongsToMany(Subspecialization::class, 'vacancy_subspecializations');
    }

    public function key_skills(): BelongsToMany
    {
        return $this->belongsToMany(KeySkill::class, 'vacancy_key_skills');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(VacancyPayment::class, 'vacancy_id', 'id');
    }

    public function payment(): mixed
    {
        foreach ($this->payments as $payment) {
            if(
                $payment->status == 'completed' &&
                Carbon::parse($payment->payed_at)->addDays(30) >= now()
            ) {
                return $payment;
            }
        }
        return null;
    }

    public function getTypeAttribute()
    {
        return $this->payment()->vacancy_type ?? null;
    }
}
