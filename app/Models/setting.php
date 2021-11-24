<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use HasFactory,SoftDeletes;
    
    public function getImageAttribute($value)
    {
        return $value?url($value):url("no_image.jpg");
    }
}
