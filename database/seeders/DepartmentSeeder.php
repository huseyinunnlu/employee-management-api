<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::create([
            'company_id' => 1,
            'city_id' => 20,
            'title' => 'Department',
            'mountly_holiday' => 8,
            'daily_work_hour' => 8,
            'overtime_rate' => 1.5,
            'overtime_type' => 'common',
        ]);
    }
}
