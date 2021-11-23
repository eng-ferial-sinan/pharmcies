<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory,SoftDeletes;


    public function orderProduct()
    {
        return $this->hasMany('App\Models\OrderProduct');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function status()
    {
        return $this->belongsTo('App\Models\Status');
    }
}
