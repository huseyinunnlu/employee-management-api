<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\Models\GlobalFunctions;

class Nation extends Model
{
    use HasFactory, GlobalFunctions;
    protected $table = 'nations';
    protected $fillable = [];

    public function titles()
    {
        return $this->hasMany(NationTitle::class, 'nation_id');
    }
}
