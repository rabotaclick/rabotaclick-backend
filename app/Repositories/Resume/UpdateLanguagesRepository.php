<?php

namespace App\Repositories\Resume;

use App\DTO\Resume\ResumeDTO;
use App\DTO\Resume\UpdateLanguagesRequestDTO;
use App\Models\Resume;
use App\Traits\PermissionTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UpdateLanguagesRepository
{
    use PermissionTrait;
    public function __construct(
        private Resume $resume
    )
    {
    }

    public function make(UpdateLanguagesRequestDTO $requestDTO, string $id): ResumeDTO
    {
        $this->resume = Resume::find($id);

        $this->checkPermission(Auth::user(), 'update', $this->resume);

        DB::transaction(function () use($requestDTO) {
            $this->manipulateLanguages($requestDTO);
            $this->resume->update($requestDTO->toArray());
        });

        return new ResumeDTO(
            $this->resume
        );
    }

    private function manipulateLanguages(UpdateLanguagesRequestDTO $requestDTO)
    {
        if(isset($requestDTO->languages)) {
            $this->attachLanguages($requestDTO->languages);
            $this->deleteLanguages($requestDTO->languages);
        }
    }

    private function attachLanguages(array $languages)
    {
        if(isset($languages['manipulate'])) {
            foreach($languages['manipulate'] as $language) {
                $this->resume->languages()
                    ->syncWithoutDetaching([$language['language_id'] => ['level' => $language['level']]]);
            }
        }
    }

    private function deleteLanguages(array $languages)
    {
        if(isset($languages['delete'])) {
            foreach ($languages['delete'] as $language) {
                $this->resume->languages()
                    ->detach($language);
            }
        }
    }
}
