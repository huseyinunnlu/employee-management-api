<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\Models\GlobalFunctions;

class TaxClass extends Model
{
    use HasFactory, GlobalFunctions;
    protected $table = 'tax_classes';
    protected $fillable = [];

    public function titles()
    {
        return $this->hasMany(TaxClassTitle::class, 'class_id');
    }
}
