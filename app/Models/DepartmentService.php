<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentService extends Model
{
    use HasFactory;
    protected $table = 'depatment_services';
    protected $fillable = ['department_id', 'service_type', 'comission_type', 'price', 'rate'];
}
