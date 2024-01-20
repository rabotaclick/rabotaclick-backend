<?php

namespace App\DTO\Resume;

use App\Models\Resume;

readonly class ResumeDTO {
    public function __construct(
        public Resume $resume
    )
    {
    }
}
