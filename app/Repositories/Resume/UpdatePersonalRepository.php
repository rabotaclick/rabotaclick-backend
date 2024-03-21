<?php declare(strict_types=1);
namespace App\Repositories\Resume;

use App\DTO\Resume\ResumeDTO;
use App\DTO\Resume\UpdatePersonalRequestDTO;
use App\Models\Resume;
use App\Traits\PermissionTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UpdatePersonalRepository
{
    use PermissionTrait;
    public function __construct(
        private Resume $resume
    )
    {
    }

    public function make(UpdatePersonalRequestDTO $requestDTO, string $id): ResumeDTO
    {
        $this->resume = Resume::find($id);
        $this->checkPermission(Auth::user(), 'update', $this->resume);
        DB::transaction(function () use($requestDTO){
            $this->resume->update($requestDTO->toArray());
        });
        return new ResumeDTO($this->resume);
    }
}
