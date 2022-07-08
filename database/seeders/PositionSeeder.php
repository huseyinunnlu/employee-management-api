<?php

namespace Database\Seeders;

use App\Models\Position;
use App\Models\PositionTitle;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $positions_tr = [
            'Yazılım personeli',
            'Kapsam dışı personel',
            'Destek personeli',
            'Araştırmacı personel',
            'Tesarım personeli',
            'Teknisyen',
        ];
        $positions_en = [
            'Software employee',
            'Out of scope employee',
            'Support employee',
            'Research employee',
            'Design employee',
            'Technician',
        ];

        foreach ($positions_tr as $key => $item) {
            $store_data = Position::create([
                'department_id' => 1,
            ]);

            PositionTitle::create([
                'lang_code' => "tr-TR",
                'position_id' => $store_data->id,
                'title' => $item,
            ]);

            PositionTitle::create([
                'lang_code' => "en-US",
                'position_id' => $store_data->id,
                'title' => $positions_en[$key],
            ]);
        }
    }
}
