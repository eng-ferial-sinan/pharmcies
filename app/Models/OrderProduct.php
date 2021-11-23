<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderProduct extends Model
{
    use HasFactory,SoftDeletes;

    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }
    public function products()
    {
        return $this->belongsTo('App\Models\Product','product_id');
    }
    public function getProductAttribute($value)
    {
        return  json_decode($value);
    }
}
