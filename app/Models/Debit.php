<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debit extends Model
{
    use HasFactory;
    protected $table = 'debits';
    protected $fillable = [
        'user_id', 'inventory_id', 'date', 'inventory_photo', 'desc', 'status'
    ];

    public function inventory()
    {
        return $this->hasOne(Inventory::class, 'id', 'inventory_id');
    }
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
