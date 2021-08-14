<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class detail extends Model
{
    use HasFactory,SoftDeletes;

    public function order()
    {
        return $this->belongsTo('App\Models\order');
    }
    public function medicine()
    {
        return $this->belongsTo('App\Models\medicine');
    }
    public function getMedicineAttribute($value)
    {
        return  json_decode($value);
    }
}
