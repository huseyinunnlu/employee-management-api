<?php

namespace App\Http\Traits;

use App\Exceptions\HttpQueryException;
use App\Models\UserPerm;
use Illuminate\Support\Facades\DB;

trait Manager
{
    public function addManager($form, $column, $id)
    {
        $stored_data = [];

        DB::beginTransaction();
        try {
            foreach ($form as $user_id) {
                $data = UserPerm::with('user')->create([
                    'user_id' => $user_id,
                    $column => $id,
                ]);
                $data->load('user');
                array_unshift($stored_data, $data->user);
            }
        } catch (\Throwable $t) {
            DB::rollBack();
        }

        DB::commit();

        return $stored_data;
    }
}
