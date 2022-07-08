<?php

namespace Database\Seeders;

use App\Models\WorkPlace;
use Illuminate\Database\Seeder;

class WorkPlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WorkPlace::create([
            'department_id' => 1,
            'city_id' => 20,
            'title' => 'Workplace',
            'morning_break' => 60,
        ]);
    }
}
