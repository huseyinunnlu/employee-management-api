<?php

namespace Database\Seeders;

use App\Models\EmployeerBranch;
use Illuminate\Database\Seeder;

class EmployeerBranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EmployeerBranch::create([
            'musteri_id' => 1,
            'employeer_title' => 'Employeer Branch',
            'tax' => '000000',
            'tax_no' => '000000',
            'website' => 'https://www.openpem.com',
            'workplace_registration_number' => '000000',
            'commercial_registration_number' => '000000',
            'address' => 'Turkey',
        ]);
    }
}
