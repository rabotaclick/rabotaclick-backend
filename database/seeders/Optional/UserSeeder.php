<?php

namespace Database\Seeders\Optional;

use App\Models\Region;
use App\Models\Resume;
use App\Models\User;
use App\Models\WorkHistory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $andrew = User::factory([
            'name' => 'Andrew',
            'surname' => 'Vasilev',
            'phone' => '+79243609722',
            'email' => 'wotacc0809@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password')
        ])->create();
        $resume = Resume::factory([
            "user_id" => $andrew->id,
            "name" => $andrew->name,
            "surname" => $andrew->surname,
            "phone" => $andrew->phone,
            "email" => $andrew->email
        ])->create();
        WorkHistory::factory([
            "resume_id" => $resume->id,
            "region_id" => Region::first()->id
        ])->create();
        $token = $andrew->createToken('auth-token')->plainTextToken;
        print('  Andrew User Token: ' . $token . "\n");
    }
}
