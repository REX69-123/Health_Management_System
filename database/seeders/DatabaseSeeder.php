<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Patient;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'Clinic Administrator',
            'email'    => 'admin@clinic.com',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        $genders = ['Male', 'Female', 'Other'];
        $statuses = ['Active', 'Active', 'Active', 'Inactive'];

        for ($i = 1; $i <= 10; $i++) {
            Patient::create([
                'patient_number' => 'PNT-' . strtoupper(Str::random(6)),
                'first_name'     => 'Dummy',
                'last_name'      => 'Patient ' . $i,
                'email'          => 'patient' . $i . '@example.com',
                'dob'            => now()->subYears(rand(18, 65))->format('Y-m-d'),
                'gender'         => $genders[array_rand($genders)],
                'status'         => $statuses[array_rand($statuses)],
                'password'       => Hash::make('password'),
            ]);
        }
    }
}
