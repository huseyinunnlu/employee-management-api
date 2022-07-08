<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    protected $table = 'inventories';
    protected $fillable = [
        'type_id', 'title', 'serial'
    ];

    public function type()
    {
        return $this->hasOne(InventoryType::class, 'id', 'type_id');
    }
}
