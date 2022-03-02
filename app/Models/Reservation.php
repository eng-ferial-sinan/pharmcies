<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use HasFactory,SoftDeletes;


    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function salon()
    {
        return $this->belongsTo('App\Models\Salon','salon_id');
    }
    public function service()
    {
        return $this->belongsTo('App\Models\Service','service_id');
    }
    

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class,'method_id');
    }
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
