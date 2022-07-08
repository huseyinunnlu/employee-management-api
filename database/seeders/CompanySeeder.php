<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::create([
            'musteri_id' => 1,
            'title' => 'Company',
            'email' => 'admin@openpem.com',
            'address' => 'Adress',
            'city_id' => 20,
        ]);
    }
}
