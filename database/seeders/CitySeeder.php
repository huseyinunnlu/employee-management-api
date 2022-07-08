<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ["title" => "Adana"],
            ["title" => "Adıyaman"],
            ["title" => "Afyonkarahisar"],
            ["title" => "Ağrı"],
            ["title" => "Amasya"],
            ["title" => "Ankara"],
            ["title" => "Antalya"],
            ["title" => "Artvin"],
            ["title" => "Aydın"],
            ["title" => "Balıkesir"],
            ["title" => "Bilecik"],
            ["title" => "Bingöl"],
            ["title" => "Bitlis"],
            ["title" => "Bolu"],
            ["title" => "Burdur"],
            ["title" => "Bursa"],
            ["title" => "Çanakkale"],
            ["title" => "Çankırı"],
            ["title" => "Çorum"],
            ["title" => "Denizli"],
            ["title" => "Diyarbakir"],
            ["title" => "Edirne"],
            ["title" => "Elazığ"],
            ["title" => "Erzincan"],
            ["title" => "Erzurum"],
            ["title" => "Eskişehir"],
            ["title" => "Gaziantep"],
            ["title" => "Giresun"],
            ["title" => "Gümüşhane"],
            ["title" => "Hakkari"],
            ["title" => "Hatay"],
            ["title" => "Isparta"],
            ["title" => "Mersin"],
            ["title" => "İstanbul"],
            ["title" => "İzmir"],
            ["title" => "Kars"],
            ["title" => "Kastamonu"],
            ["title" => "Kayseri"],
            ["title" => "Kırklareli"],
            ["title" => "Kırşehir"],
            ["title" => "Kocaeli"],
            ["title" => "Konya"],
            ["title" => "Kütahya"],
            ["title" => "Malatya"],
            ["title" => "Manisa"],
            ["title" => "Kahramanmaraş"],
            ["title" => "Mardin"],
            ["title" => "Muğla"],
            ["title" => "Muş"],
            ["title" => "Nevşehir"],
            ["title" => "Niğde"],
            ["title" => "Ordu"],
            ["title" => "Rize"],
            ["title" => "Sakarya"],
            ["title" => "Samsun"],
            ["title" => "Siirt"],
            ["title" => "Sinop"],
            ["title" => "Sivas"],
            ["title" => "Tekirdağ"],
            ["title" => "Tokat"],
            ["title" => "Trabzon"],
            ["title" => "Tunceli"],
            ["title" => "Şanlıurfa"],
            ["title" => "Uşak"],
            ["title" => "Van"],
            ["title" => "Yozgat"],
            ["title" => "Zonguldak"],
            ["title" => "Aksaray"],
            ["title" => "Bayburt"],
            ["title" => "Karaman"],
            ["title" => "Kırıkkale"],
            ["title" => "Batman"],
            ["title" => "Şırnak"],
            ["title" => "Bartın"],
            ["title" => "Ardahan"],
            ["title" => "Iğdır"],
            ["title" => "Yalova"],
            ["title" => "Karabük"],
            ["title" => "Kilis"],
            ["title" => "Osmaniye"],
            ["title" => "Düzce"]
        ];

        foreach ($data as $item) {
            City::create([
                'title' => $item['title'],
                'country_id' => 232,
            ]);
        }
    }
}
