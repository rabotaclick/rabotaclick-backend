<?php declare(strict_types=1);

namespace App\DTO\Resume;

use App\Models\Language;
use App\Traits\FilterDataTrait;

readonly class UpdateLanguagesRequestDTO
{
    use FilterDataTrait;
    public function __construct(
        public Language|null    $main_language = null,
        public array|null       $languages = null,
    )
    {
    }

    public function toArray(): array
    {
        $data = [
            "main_language_id" => $this->main_language->id ?? null,
        ];

        return $this->filterData($data);
    }
}
