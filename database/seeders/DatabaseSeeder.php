<?php

namespace Database\Seeders;

use App\Enums\UserTypeEnum;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'patient@example.com',
            'phone' => '1234567890',
            'type' => UserTypeEnum::PATIENT->value,
        ]);
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'doctor@example.com',
            'phone' => '1234567800',
            'type' => UserTypeEnum::DOCTOR->value,
        ]);
    }
}
