<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\RoleTitle;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data_tr = [
            'Super admin', //1
            'Admin yönetici', //2
            'Şirket yöneticisi', //3
            'Personel', //4
            'Departman sorumlusu', //5
            'Admin sorumlu', //6
            'Departman yöneticisi', //7
        ];

        $data_en = [
            'Super admin',
            'Admin manager',
            'Company manager',
            'Employee',
            'Department head',
            'Admin head',
            'Department manager',
        ];

        foreach ($data_tr as $key => $item) {
            $store_data = Role::create();

            RoleTitle::create([
                'lang_code' => "tr-TR",
                'role_id' => $store_data->id,
                'title' => $item,
            ]);

            RoleTitle::create([
                'lang_code' => "en-US",
                'role_id' => $store_data->id,
                'title' => $data_en[$key],
            ]);
        }
    }
}
