<?php

namespace Database\Seeders;

use App\Models\DocumentType;
use App\Models\DocumentTypeTitle;
use Illuminate\Database\Seeder;

class documentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $doc_types_tr = [
            'CV',
            'Fotoğraf',
            'Pasaport',
            'Kimlik',
            'Maaş bordrosu',
            'Çalışma sertifikası',
            'Sağlık Raporu',
            'İade talebi',
            'Öğrenci belgesi',
        ];
        $doc_types_en = [
            'CV',
            'Photo',
            'Passport',
            'Id card',
            'Payroll',
            'Work certificate',
            'Healt Report',
            'Extradition request',
            'Student certificate',
        ];
        foreach ($doc_types_tr as $key => $item) {
            $store_data = DocumentType::create();

            DocumentTypeTitle::create([
                'lang_code' => 'tr-TR',
                'type_id' => $store_data->id,
                'title' => $item,
            ]);

            DocumentTypeTitle::create([
                'lang_code' => 'en-US',
                'type_id' => $store_data->id,
                'title' => $doc_types_en[$key],
            ]);
        }
    }
}
