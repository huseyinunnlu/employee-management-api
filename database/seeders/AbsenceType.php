<?php

namespace Database\Seeders;

use App\Models\AbsenceType as ModelsAbsenceType;
use App\Models\AbsenceTypeTitle;
use Illuminate\Database\Seeder;

class AbsenceType extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $absences_tr = [
            'Seyahat',
            'İzin',
            'Kısa süreli çalışma',
        ];
        $absences_en = [
            'Vacation',
            'Time of',
            'Short-time work',
        ];

        foreach ($absences_tr as $key => $item) {
            $store_data = ModelsAbsenceType::create();

            AbsenceTypeTitle::create([
                'lang_code' => "tr-TR",
                'type_id' => $store_data->id,
                'title' => $item,
            ]);

            AbsenceTypeTitle::create([
                'lang_code' => "en-US",
                'type_id' => $store_data->id,
                'title' => $absences_tr[$key],
            ]);
        }
    }
}
