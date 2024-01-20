<?php

namespace Database\Seeders\Important;

use App\Models\DriverCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DriverCategoriesSeeder extends Seeder
{
    private array $categories;
    public function __construct()
    {
        $this->categories = [
            'A',
            'B',
            'C',
            'D',
            'E',
            'BE',
            'CE',
            'DE',
            'Tm',
            'Tb',
        ];
    }
    public function run(): void
    {
        foreach ($this->categories as $category) {
            DriverCategory::factory([
                'category' => $category
            ])->create();
        }
    }
}
