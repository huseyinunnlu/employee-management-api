<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Department;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            LanguageSeeder::class,
            JobSeeder::class,
            CountrySeeder::class,
            CitySeeder::class,
            NationSeeder::class,
            documentSeeder::class,
            RoleSeeder::class,
            MusteriSeeder::class,
            AbsenceType::class,
            CompanySeeder::class,
            DepartmentSeeder::class,
            PositionSeeder::class,
            JobSeeder::class,
            EmployeerBranchSeeder::class,
            WorkPlaceSeeder::class,
            InventorySeeder::class,
            UserSeeder::class,
        ]);
    }
}
