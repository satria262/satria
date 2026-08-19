<?php

namespace App\Models;

use App\Models\EmployeeDetail;
use App\Models\Store;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'store_id',
        'name',
        'position',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function employeedetail()
    {
        return $this->hasOne(EmployeeDetail::class);
    }
}
