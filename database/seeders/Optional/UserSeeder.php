<?php

namespace Database\Seeders\Optional;

use App\Models\User;
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
        $token = $andrew->createToken('auth-token')->plainTextToken;
        print('  Andrew User Token: ' . $token . "\n");
    }
}
