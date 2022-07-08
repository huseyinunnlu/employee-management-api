<?php

namespace Database\Seeders;

use App\Models\Musteri;
use Illuminate\Database\Seeder;

class MusteriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Musteri::create([
            'title' => 'Musteri',
        ]);
    }
}
