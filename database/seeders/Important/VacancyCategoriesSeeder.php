<?php

namespace Database\Seeders\Important;

use App\Models\VacancyCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VacancyCategoriesSeeder extends Seeder
{
    private array $vacancies;
    public function __construct()
    {
        $this->vacancies = [
            "IT, интернет, связь",
            "Автомобильный бизнес",
            "Административный персонал",
            "Без опыта работы",
            "Бухгалтерия, аудит, консалтинг"
        ];
    }

    public function run(): void
    {
        foreach ($this->vacancies as $vacancy) {
            VacancyCategory::factory([
               "title" => $vacancy
            ])->create();
        }
    }
}
