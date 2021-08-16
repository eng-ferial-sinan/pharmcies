<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class medicine extends Model
{
    use HasFactory,SoftDeletes;

    public function getImageAttribute($value)
    {
        return $value?url($value):url("medicines.jpg");
    }

    public function category()
    {
        return $this->belongsTo('App\Models\category');
    }
}
