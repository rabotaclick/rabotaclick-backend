<?php

namespace App\Repositories\Country;

use App\DTO\Country\CountriesDTO;
use App\Models\Country;

class IndexRepository
{
    public function make(): CountriesDTO
    {
        $countries = Country::query();
        $totalRowCount = $countries->count();
        $countries = $countries->get();

        return new CountriesDTO(
            $countries,
            $totalRowCount
        );
    }
}
