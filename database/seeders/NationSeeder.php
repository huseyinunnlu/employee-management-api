<?php

namespace Database\Seeders;

use App\Models\Nation;
use App\Models\NationTitle;
use Illuminate\Database\Seeder;

class NationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $data_tr = [
            "Türk",
            "Alman",
            "İngiliz",
            "Amerikan",
            "Arap",
            "Latin",
            "Fransız",
            "Rus"
        ];
        $data_en = [
            "Turkish",
            "German",
            "British",
            "American",
            "Arabic",
            "Latin",
            "France",
            "Russian"
        ];


        foreach ($data_tr as $key => $item) {
            $create_data = Nation::create();

            NationTitle::create([
                'nation_id' => $create_data->id,
                'lang_code' => "tr-TR",
                'title' => $item,
            ]);

            NationTitle::create([
                'nation_id' => $create_data->id,
                'lang_code' => "en-US",
                'title' => $data_en[$key],
            ]);
        }
    }
}
