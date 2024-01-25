<?php

namespace App\Repositories\Resume;

use App\DTO\Resume\ResumeDTO;
use App\DTO\Resume\UpdateWorkingHistoryRequestDTO;
use App\Models\Resume;
use App\Models\WorkHistory;
use App\Traits\PermissionTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UpdateWorkingHistoryRepository
{
    use PermissionTrait;
    public function __construct(
        public Resume $resume
    )
    {
    }

    public function make(UpdateWorkingHistoryRequestDTO $requestDTO, string $id): ResumeDTO
    {
        $this->resume = Resume::find($id);
        $this->checkPermission(Auth::user(), 'update', $this->resume);
        DB::transaction(function () use($requestDTO) {
            $this->manipulateWorkHistories($requestDTO);
            $this->manipulateKeySkills($requestDTO);
            $this->syncDriverCategories($requestDTO);
            $this->resume->update($requestDTO->toArray());
        });
        return new ResumeDTO(
            $this->resume
        );
    }
    private function syncDriverCategories(UpdateWorkingHistoryRequestDTO $requestDTO)
    {
        if(isset($requestDTO->driver_categories)) {
            $this->resume->driver_categories()->sync($requestDTO->driver_categories);
        }
    }
    private function manipulateKeySkills(UpdateWorkingHistoryRequestDTO $requestDTO)
    {
        if(isset($requestDTO->key_skills)) {
            $this->attachKeySkills($requestDTO->key_skills);
            $this->deleteKeySkills($requestDTO->key_skills);
        }
    }
    private function attachKeySkills($keySkills)
    {
        if(isset($keySkills['create'])) {
            foreach($keySkills['create'] as $keySkill) {
                $this->resume->key_skills()->syncWithoutDetaching($keySkill);
            }
        }
    }
    private function deleteKeySkills($keySkills)
    {
        if(isset($keySkills['delete'])) {
            foreach($keySkills['delete'] as $keySkill) {
                $this->resume->key_skills()->detach($keySkill);
            }
        }
    }
    private function manipulateWorkHistories(UpdateWorkingHistoryRequestDTO $requestDTO)
    {
        if(isset($requestDTO->work_histories)) {
            $this->attachWorkHistories($requestDTO->work_histories);
            $this->deleteWorkHistories($requestDTO->work_histories);
            $this->updateWorkHistories($requestDTO->work_histories);
        }
    }
    private function attachWorkHistories($workHistories)
    {
        if(isset($workHistories['create'])) {
            foreach($workHistories['create'] as $newWorkHistory) {
                $newWorkHistory['resume_id'] = $this->resume->id;
                WorkHistory::create($newWorkHistory);
            }
        }
    }
    private function deleteWorkHistories($workHistories)
    {
        if(isset($workHistories['delete'])) {
            foreach($workHistories['delete'] as $deleteWorkHistory) {
                $this->resume->work_histories()
                    ->where('id', $deleteWorkHistory)
                    ->delete();
            }
        }
    }
    private function updateWorkHistories($workHistories)
    {
        if(isset($workHistories['update'])) {
            foreach($workHistories['update'] as $updateWorkHistory) {
                $this->resume->work_histories()
                    ->where("id", $updateWorkHistory['id'])
                    ->update($updateWorkHistory);
            }
        }
    }
}
