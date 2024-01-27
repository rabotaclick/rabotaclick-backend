<?php

namespace App\Repositories\Resume;

use App\DTO\Resume\IndexRequestDTO;
use App\DTO\Resume\IndexResponseDTO;
use App\Models\Resume;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class IndexRepository
{
    public function __construct(
        private mixed $resumes = null
    )
    {
    }
    public function make(IndexRequestDTO $requestDTO): IndexResponseDTO
    {
        $this->search($requestDTO);
        $this->filterDate($requestDTO->date);
        $this->filterCity($requestDTO->city);
        $this->filterReadyToMove($requestDTO->ready_to_move);
        $this->filterWorkHistorySpecializations($requestDTO->work_history_specializations);
        $this->filterUserStatus($requestDTO->user_status);
        $this->filterAge($requestDTO->age, $requestDTO->isset_age);
        $this->filterOccupation($requestDTO->occupation);
        $this->filterSchedule($requestDTO->schedule);
        $this->filterWorkExperience($requestDTO->work_experience);
        $this->filterSubspecializations($requestDTO->subspecializations);
        $this->filterGender($requestDTO->gender, $requestDTO->isset_gender);
        $this->filterSalary($requestDTO->salary, $requestDTO->isset_salary);
        $this->filterEducation($requestDTO->education);

        $this->resumes = $this->resumes->orderBy($requestDTO->column,$requestDTO->orderBy);
        $this->resumes = $this->resumes->paginate($requestDTO->first,page: $requestDTO->page);

        $this->resumes->appends([
            'first' => $requestDTO->first
        ]);

        return new IndexResponseDTO(
            $this->resumes,
        );
    }

    private function search(IndexRequestDTO $requestDTO)
    {
        if(isset($requestDTO->search)) {
            $this->resumes = Resume::search($requestDTO->search);
        } else {
            $this->resumes = Resume::search();
        }
    }

    private function filterDate($date)
    {
        $from = Carbon::now();
        switch ($date) {
            case 'day':
                $from = $from->subDay();
                break;
            case 'three_days':
                $from = $from->subDays(3);
                break;
            case 'week':
                $from = $from->subWeek();
                break;
            case 'month':
                $from = $from->subMonth();
                break;
            case 'year':
                $from = $from->subYear();
                break;
        }
        $this->resumes = $this->resumes->query(fn (Builder $query) =>
            $query->whereBetween('updated_at',[
                $from->format('Y-m-d'),
                Carbon::now()->addDay()->format('Y-m-d')
            ])
        );
    }

    private function filterCity($city)
    {
        if(isset($city)) {
            $this->resumes = $this->resumes->where('city_id', '=', $city->id);
        }
    }

    private function filterReadyToMove($ready_to_move)
    {
        if(isset($ready_to_move)) {
            $this->resumes = $this->resumes->where('ready_to_move', '=', $ready_to_move);
        }
    }

    private function filterWorkHistorySpecializations($work_history_specializations)
    {
        if(isset($work_history_specializations)) {
            switch ($work_history_specializations['date']) {
                case 'year':
                    $start_filter_date = Carbon::now()->subYear();
                    break;
                case 'three_years':
                    $start_filter_date = Carbon::now()->subYears(3);
                    break;
                case 'six_years':
                    $start_filter_date = Carbon::now()->subYears(6);
                    break;
                default:
                    $start_filter_date = Carbon::now()->subYears(100);
            }
            $this->resumes = $this->resumes->query(fn (Builder $query) =>
                $query->whereHas('work_histories', function(Builder $query) use($work_history_specializations, $start_filter_date){
                    $query->where('start_date', '>=', $start_filter_date->format('Y-m-d'));
                    $query->whereHas('subspecializations', function (Builder $query) use ($work_history_specializations) {
                        $query->whereIn('subspecialization_id', $work_history_specializations['subspecializations']);
                    });
                })
            );
        }
    }

    private function filterUserStatus($user_status)
    {
        if(isset($user_status)) {
            $this->resumes = $this->resumes->query(fn (Builder $query) =>
                $query->whereRelation('user','status', '=', $user_status)
            );
        }
    }

    private function filterAge($age, $issetAge = false)
    {
        if(isset($age)) {
            $fromBirthdate = Carbon::now()->subYears($age['to'])->format('Y-m-d');
            $toBirthdate = Carbon::now()->subYears($age['from'])->format('Y-m-d');
            $this->resumes = $this->resumes->query(fn (Builder $query) =>
                $query->whereBetween('birthdate', [$fromBirthdate, $toBirthdate])
            );
        }
        if($issetAge) {
            $this->resumes = $this->resumes->query(fn (Builder $query) =>
                $query->where('birthdate','!=', null)
            );
        }
    }

    private function filterOccupation($occupation)
    {
        if(isset($occupation)) {
            $this->resumes = $this->resumes->where('occupation', '=', $occupation);
        }
    }

    private function filterSchedule($schedule)
    {
        if(isset($schedule)) {
            $this->resumes = $this->resumes->where('schedule', '=', $schedule);
        }
    }

    private function filterWorkExperience($work_experience)
    {
        if (isset($work_experience)) {
            switch ($work_experience) {
                case 'zero':
                    $work_months_from = 0;
                    $work_months_to = 12;
                    break;
                case 'one_to_three':
                    $work_months_from = 12;
                    $work_months_to = 36;
                    break;
                case 'three_to_six':
                    $work_months_from = 36;
                    $work_months_to = 72;
                    break;
                case 'more_than_six':
                    $work_months_from = 72;
                    $work_months_to = 9999;
                    break;
            }
            $this->resumes = $this->resumes->where('work_experience', 'TO', [$work_months_from,$work_months_to]);
        }
    }

    private function filterSubspecializations($subspecializations)
    {
        if(isset($subspecializations)) {
            $this->resumes = $this->resumes->query(fn (Builder $query) =>
                $query->whereHas('subspecializations', function(Builder $query) use($subspecializations) {
                    $query->whereIn('subspecialization_id', $subspecializations);
                })
            );
        }
    }

    private function filterGender($gender, $issetGender = false)
    {
        if(isset($gender)) {
            $this->resumes = $this->resumes->where('gender', '=', $gender);
        }
        if(isset($issetGender)) {
            $this->resumes = $this->resumes->query(fn (Builder $query) =>
                $query->where('gender','!=', null)
            );
        }
    }

    private function filterSalary($salary, $issetSalary = false)
    {
        if(isset($salary)) {
            $this->resumes = $this->resumes->query(fn (Builder $query) =>
                $query->whereBetween('salary', [$salary['from'], $salary['to']])
            );
        }
        if(isset($issetSalary)) {
            $this->resumes = $this->resumes->query(fn (Builder $query) =>
                $query->where('salary','!=', null)
            );
        }
    }

    private function filterEducation($education)
    {
        if(isset($education)) {
            $this->resumes = $this->resumes->query(fn(Builder $query) =>
                $query->whereHas('education_places', function (Builder $query) use($education) {
                    $query->where("education", "=", $education);
                })
            );
        }
    }
}
