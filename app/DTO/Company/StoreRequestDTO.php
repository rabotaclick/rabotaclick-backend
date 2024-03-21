<?php declare(strict_types=1);

namespace App\DTO\Company;

use App\Models\City;
use App\Models\Specialization;
use Illuminate\Http\UploadedFile;

readonly class StoreRequestDTO
{
    public function __construct(
        public string               $type,
        public string               $name,
        public City                 $city,
        public string|null          $website = null,
        public Specialization       $specialization,
        public string               $phone,
        public string|null          $description = null,
        public UploadedFile|null    $document = null
    )
    {
    }
}
