<?php declare(strict_types=1);
namespace App\Repositories\Resume;

use App\DTO\Resume\ResumeDTO;
use App\DTO\Resume\UpdatePhotoRequestDTO;
use App\Models\Resume;
use App\Models\ResumePhoto;
use App\Traits\PermissionTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UpdatePhotoRepository
{
    use PermissionTrait;

    public function __construct(
        private Resume $resume
    )
    {
    }

    public function make(UpdatePhotoRequestDTO $requestDTO, string $id): ResumeDTO
    {
        $this->resume = Resume::find($id);

        $this->checkPermission(Auth::user(), 'update', $this->resume);

        DB::transaction(function() use($requestDTO) {
           $this->manipulateResumePhoto($requestDTO);
        });

        return new ResumeDTO(
            $this->resume
        );
    }

    private function manipulateResumePhoto(UpdatePhotoRequestDTO $requestDTO)
    {
        if(is_null($requestDTO->url)) {
            $this->resume->photo()->delete();
        } else {
            $photo = ResumePhoto::firstOrNew(["resume_id" => $this->resume->id]);
            $photo->url = $requestDTO->url;
            $photo->save();
        }
    }
}
