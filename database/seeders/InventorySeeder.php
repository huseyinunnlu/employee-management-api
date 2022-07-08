<?php

namespace Database\Seeders;

use App\Models\Inventory;
use App\Models\InventoryType;
use Illuminate\Database\Seeder;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $inventories = ['Macbook', 'Monster', 'Hp', 'Lenovo'];

        $data = InventoryType::create([
            'company_id' => 1,
            'title' => 'Computers',
        ]);
        foreach ($inventories as $inventory) {
            Inventory::create([
                'type_id' => $data->id,
                'title' => $inventory,
            ]);
        }
    }
}
