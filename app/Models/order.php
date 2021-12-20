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
    public function driver()
    {
        return $this->belongsTo('App\Models\User','driver_id');
    }
    public function status()
    {
        return $this->belongsTo('App\Models\Status');
    }
    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class,'payment_method_id');
    }
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
