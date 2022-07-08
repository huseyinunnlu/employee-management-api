<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\Models\GlobalFunctions;

class Job extends Model
{
    use HasFactory, GlobalFunctions;
    protected $table = 'jobs';
    protected $fillable = ['code'];

    public function titles()
    {
        return $this->hasMany(JobTitle::class, 'job_id');
    }
}
