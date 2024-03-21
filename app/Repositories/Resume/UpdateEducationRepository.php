<?php declare(strict_types=1);
namespace App\Repositories\Resume;

use App\DTO\Resume\ResumeDTO;
use App\DTO\Resume\UpdateEducationRequestDTO;
use App\Models\EducationPlace;
use App\Models\Resume;
use App\Traits\PermissionTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UpdateEducationRepository
{
    use PermissionTrait;

    public function __construct(
        private Resume $resume
    )
    {
    }

    public function make(UpdateEducationRequestDTO $requestDTO, string $id): ResumeDTO
    {
        $this->resume = Resume::find($id);
        $this->checkPermission(Auth::user(), 'update', $this->resume);

        DB::transaction(function() use($requestDTO) {
            $this->manipulateEducationPlaces($requestDTO);
        });

        return new ResumeDTO(
            $this->resume
        );
    }

    private function manipulateEducationPlaces(UpdateEducationRequestDTO $requestDTO)
    {
        if(isset($requestDTO->education_places)) {
            $this->attachEducationPlaces($requestDTO->education_places);
            $this->deleteEducationPlaces($requestDTO->education_places);
            $this->updateEducationPlaces($requestDTO->education_places);
        }
    }

    private function attachEducationPlaces($educationPlaces)
    {
        if(isset($educationPlaces['create'])) {
            foreach($educationPlaces['create'] as $educationPlace) {
                $educationPlace['resume_id'] = $this->resume->id;
                EducationPlace::create($educationPlace);
            }
        }
    }

    private function deleteEducationPlaces($educationPlaces)
    {
        if(isset($educationPlaces['delete'])) {
            foreach($educationPlaces['delete'] as $educationPlace) {
                $this->resume->education_places()
                    ->where('id', $educationPlace)
                    ->delete();
            }
        }
    }

    private function updateEducationPlaces($educationPlaces)
    {
        if(isset($educationPlaces['update'])) {
            foreach($educationPlaces['update'] as $educationPlace) {
                $this->resume->education_places()
                    ->where('id', $educationPlace['id'])
                    ->update($educationPlace);
            }
        }
    }
}
