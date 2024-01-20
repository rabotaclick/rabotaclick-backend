<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\Important\DriverCategoriesSeeder;
use Database\Seeders\Important\KeySkillsSeeder;
use Database\Seeders\Important\LanguagesSeeder;
use Database\Seeders\Important\SpecializationsSeeder;
use Database\Seeders\Important\SubjectsSeeder;
use Database\Seeders\Important\VacancyCategoriesSeeder;
use Database\Seeders\Optional\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if(env("APP_ENV") == 'production') {
            $this->call([
                SpecializationsSeeder::class,
                KeySkillsSeeder::class,
                SubjectsSeeder::class,
                LanguagesSeeder::class,
                DriverCategoriesSeeder::class
            ]);
        } else {
            $this->call([
                SpecializationsSeeder::class,
                KeySkillsSeeder::class,
                SubjectsSeeder::class,
                LanguagesSeeder::class,
                DriverCategoriesSeeder::class,
                UserSeeder::class
            ]);
        }

    }
}
