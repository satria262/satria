<?php

namespace App\Models;

use App\Models\OrderDetail;
use App\Models\ProductDetail;
use App\Models\Store;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'store_id',
        'name',
        'price',
        'stock',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function productdetail()
    {
        return $this->hasOne(ProductDetail::class);
    }

    public function orderdetail()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
