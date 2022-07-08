<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryType extends Model
{
    use HasFactory;
    protected $table = 'inventory_types';
    protected $fillable = [
        'company_id', 'title'
    ];
}
