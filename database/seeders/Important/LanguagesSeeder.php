<?php

namespace Database\Seeders\Important;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguagesSeeder extends Seeder
{
    private array $languages;
    public function __construct()
    {
        $this->languages = [
            'Русский язык',
            'Англиский язык',
            'Китайский язык',
            'Якутский язык',
            'Турецкий язык',
            'Казахский язык',
            'Немецкий язык',
            'Тайский язык',
            'Корейский язык',
            'Японский язык',
            'Францсузкий язык',
            'Финский язык'
        ];
    }

    public function run(): void
    {
        foreach ($this->languages as $language) {
            Language::factory([
                'name' => $language
            ])->create();
        }
    }
}
