<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'slug' => "test-admin-1",
                'role_id' => 1,
                'language_id' => 1,
                'musteri_id' => 1,
                'company_id' => 1,
                'department_id' => 1,
                'position_id' => 1,
                'work_place_id' => 1,
                'employeer_branch_id' => 1,
                'job_id' => 1,
                'start_date' => now(),
                'birthday' => now(),
                'work_type' => 1,
                'work_status' => 1,
                'insurance_status' => 1,
                'disability_status' => 1,
                'first_name' => "Test",
                'last_name' => "Admin",
                'registration_number' => 1,
                'email' => "admin@openpem.com",
                'born_place_id' => 20,
                'city_id' => 20,
                'gender' => 'male',
                'nation_id' => 1,
                'email_verified_at' => now(),
                'password' => '$2y$10$1uwocYljiuhzQCWBaXtxt.zK5xY4Ps7IPgJR9QlcGs1gTeGrNxAHe', // openpem2022
                'remember_token' => Str::random(10),
            ], [
                'slug' => "test-user-2",
                'role_id' => 4,
                'language_id' => 1,
                'musteri_id' => 1,
                'company_id' => 1,
                'position_id' => 1,
                'department_id' => 1,
                'work_place_id' => 1,
                'employeer_branch_id' => 1,
                'job_id' => 1,
                'start_date' => now(),
                'birthday' => now(),
                'work_type' => 1,
                'work_status' => 1,
                'insurance_status' => 1,
                'disability_status' => 1,
                'first_name' => "Test",
                'last_name' => "User",
                'registration_number' => 2,
                'email' => "user@openpem.com",
                'born_place_id' => 20,
                'city_id' => 20,
                'gender' => 'male',
                'nation_id' => 1,
                'email_verified_at' => now(),
                'password' => '$2y$10$1uwocYljiuhzQCWBaXtxt.zK5xY4Ps7IPgJR9QlcGs1gTeGrNxAHe', // openpem2022
                'remember_token' => Str::random(10),
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
