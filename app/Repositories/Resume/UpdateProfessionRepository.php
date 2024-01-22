<?php

namespace App\Repositories\Resume;

use App\DTO\Resume\ResumeDTO;
use App\DTO\Resume\UpdateProfessionRequestDTO;
use App\Models\Resume;
use App\Traits\PermissionTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UpdateProfessionRepository
{
    use PermissionTrait;
    public function __construct(
        private Resume $resume
    )
    {
    }

    public function make(UpdateProfessionRequestDTO $requestDTO, string $id): ResumeDTO
    {
        $this->resume = Resume::find($id);
        $this->checkPermission(Auth::user(), 'update', $this->resume);
        DB::transaction(function () use($requestDTO){
            $requestDTO = $requestDTO->toArray();
            $this->updateSubspecializations($requestDTO);
            $this->resume->update($requestDTO);
        });
        return new ResumeDTO($this->resume);
    }

    private function updateSubspecializations($requestDTO)
    {
        $subspecializations = $requestDTO['subspecializations'];
        if(isset($subspecializations) && $subspecializations != []) {
            if(isset($subspecializations['add'])) {
                $this->attachSubspecializations($subspecializations['add']);
            }
            if(isset($subspecializations['remove'])) {
                $this->detachSubspecializations($subspecializations['remove']);
            }
            unset($requestDTO['subspecializations']);
        }
    }
    private function attachSubspecializations(array $adds)
    {
        foreach ($adds as $subspecialization) {
            $this->resume->subspecializations()->syncWithoutDetaching($subspecialization);
        }
    }
    private function detachSubspecializations(array $removes)
    {

        foreach ($removes as $subspecialization) {
            $this->resume->subspecializations()->detach($subspecialization);
        }
    }
}
