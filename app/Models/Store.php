<?php

namespace App\Models;

use App\Models\Employee;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function employee()
    {
        return $this->hasMany(Employee::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
