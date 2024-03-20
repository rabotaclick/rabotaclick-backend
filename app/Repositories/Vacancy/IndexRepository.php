<?php

namespace App\Repositories\Vacancy;

use App\DTO\Vacancy\IndexRequestDTO;
use App\DTO\Vacancy\IndexResponseDTO;
use App\Models\Vacancy;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class IndexRepository
{
    public function __construct(
        private mixed $vacancies = null
    )
    {
    }

    public function make(IndexRequestDTO $requestDTO): IndexResponseDTO
    {
        $this->search($requestDTO);
        $this->filterDate($requestDTO->date);
        $this->filterSalary($requestDTO->salary, $requestDTO->isset_salary);
        $this->filterCity($requestDTO->city);
        $this->filterSubspecializations($requestDTO->subspecializations);
        $this->filterEducation($requestDTO->education);
        $this->filterWorkExperience($requestDTO->work_experience);
        $this->filterOccupation($requestDTO->occupation);
        $this->filterSchedule($requestDTO->schedule);

        $this->vacancies = $this->vacancies->orderBy($requestDTO->column,$requestDTO->orderBy);
        $this->vacancies = $this->vacancies->paginate($requestDTO->first,page: $requestDTO->page);

        $this->vacancies->appends([
            'first' => $requestDTO->first
        ]);

        return new IndexResponseDTO(
            $this->vacancies
        );
    }

    private function search(IndexRequestDTO $requestDTO)
    {
        if(isset($requestDTO->search)) {
            $this->vacancies = Vacancy::search($requestDTO->search);
        } else {
            $this->vacancies = Vacancy::search();
        }
        $this->vacancies = $this->vacancies->where('is_active','=', 'true');
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
        $this->vacancies = $this->vacancies->query(fn (Builder $query) =>
        $query->whereBetween('updated_at',[
            $from->format('Y-m-d'),
            Carbon::now()->addDay()->format('Y-m-d')
        ])
        );
    }

    private function filterCity($city)
    {
        if(isset($city)) {
            $this->vacancies = $this->vacancies->where('city_id','=', $city->id);
        }
    }

    private function filterSalary($salary, $issetSalary = false)
    {
        if(isset($issetSalary)) {
            $this->vacancies = $this->vacancies->query(fn (Builder $query) =>
                $query->where('salary_from','!=', null)
            );
            if(isset($salary) && $issetSalary == true) {
                $this->vacancies = $this->vacancies->query(fn (Builder $query) =>
                    $query->where('salary_from','>=',intval($salary))
                );
            }
        }
    }

    private function filterSubspecializations($subspecializations)
    {
        if(isset($subspecializations)) {
            $this->vacancies = $this->vacancies->query(fn (Builder $query) =>
            $query->whereHas('subspecializations', function(Builder $query) use($subspecializations) {
                $query->whereIn('subspecialization_id', $subspecializations);
            })
            );
        }
    }

    private function filterEducation($education)
    {
        if(isset($education)) {
            $this->vacancies = $this->vacancies->where('education','=', $education);
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
            $this->vacancies = $this->vacancies->where('work_experience', 'TO', [$work_months_from,$work_months_to]);
        }
    }

    private function filterOccupation($occupation)
    {
        if(isset($occupation)) {
            $this->vacancies = $this->vacancies->where('occupation', '=', $occupation);
        }
    }

    private function filterSchedule($schedule)
    {
        if(isset($schedule)) {
            $this->vacancies = $this->vacancies->where('schedule', '=', $schedule);
        }
    }
}
