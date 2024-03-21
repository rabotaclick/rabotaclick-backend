<?php declare(strict_types=1);

namespace App\DTO\Country;

use Illuminate\Database\Eloquent\Collection;

readonly class CountriesDTO
{
    public function __construct(
        public Collection $countries,
        public int        $totalRowCount
    )
    {
    }
}
