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
            "Бухгалтерия, аудит, консалтинг",
            "Бытовые услуги",
            "Бюджетные и гос. организации",
            "ЖКХ, благоустройство",
            "Культура и искусство",
            "Логистика, склад, закупки",
            "Маркетинг, реклама, PR, дизайн",
            "Медицина и фармацевтика",
            "Образование и наука",
            "Отдел кадров и HR",
            "Продажи, сбыт, торговля",
            "Промышленность и производство",
            "Рабочий персонал и разнорабочие",
            "Развлечения, рестораны, кафе",
            "Разовая и временная работа",
            "Руководители, топ-менеджмент",
            "Сельское хозяйство",
            "Служба безопасности",
            "СМИ и полиграфия",
            "Спорт и красота",
            "Строительство и недвижимость",
            "Туризм и гостиничное дело",
            "Финансы, экономика, страхование",
            "Юриспруденция",
            "Другое"
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
