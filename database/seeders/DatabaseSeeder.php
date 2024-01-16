<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\Important\VacancyCategoriesSeeder;
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
                VacancyCategoriesSeeder::class
            ]);
        } else {
            $this->call([
                VacancyCategoriesSeeder::class
            ]);
        }

    }
}
