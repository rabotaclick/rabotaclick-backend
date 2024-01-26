<?php

namespace App\Repositories\Resume;

use App\DTO\Resume\ResumeDTO;
use App\Models\Resume;

class ShowRepository
{
    public function __construct(
        private Resume $resume,
    )
    {
    }

    public function make(string $id): ResumeDTO
    {
        $this->resume = Resume::find($id);

        return new ResumeDTO(
            $this->resume
        );
    }
}
