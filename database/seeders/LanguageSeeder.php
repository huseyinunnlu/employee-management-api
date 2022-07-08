<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $languages = [
            [
                'title' => "Türkçe",
                'code' => "tr-TR",
            ],
            [
                'title' => "English",
                'code' => "en-US"
            ],
            [
                'title' => "Duits",
                'code' => "nl",
            ],
            [
                'title' => "Deutsch",
                'code' => "de",
            ],
            [
                'title' => "Français",
                'code' => "fr",
            ],
            [
                'title' => "Руска",
                'code' => "ru",
            ],
            [
                'title' => "український",
                'code' => "ua",
            ],
        ];

        foreach ($languages as $item) {
            Language::create([
                'title' => $item['title'],
                'code' => $item['code'],
            ]);
        }
    }
}
