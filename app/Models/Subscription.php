<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{
    use HasFactory,SoftDeletes;

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function plan()
    {
        return $this->belongsTo('App\Models\Plan','plan_id');
    }
    public function status()
    {
        return $this->belongsTo('App\Models\Status');
    }
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
