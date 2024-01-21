<?php

namespace App\Repositories\Resume;

use App\DTO\Resume\ResumeDTO;
use App\DTO\Resume\UpdateContactsRequestDTO;
use App\Models\Resume;
use App\Traits\PermissionTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UpdateContactsRepository
{
    use PermissionTrait;
    public function __construct(
        private Resume $resume
    )
    {
    }
    public function make(UpdateContactsRequestDTO $requestDTO, string $id): ResumeDTO
    {
        $this->resume = Resume::find($id);
        $this->checkPermission(Auth::user(), 'update', $this->resume);
        DB::transaction(function () use($requestDTO){
            $this->resume->update($requestDTO->toArray());
        });
        return new ResumeDTO($this->resume);
    }
}
