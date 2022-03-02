<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Salon extends Model
{
    use HasFactory,SoftDeletes;

    public function getImageAttribute($value)
    {
        return $value?url($value):url("no_image.jpg");
    }
    public function Service()
    {
        return $this->hasMany('App\Models\Service');
    }
}
