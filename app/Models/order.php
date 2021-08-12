<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class order extends Model
{
    use HasFactory,SoftDeletes;


    public function details()
    {
        return $this->hasMany('App\Models\detail');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function pharmacy()
    {
        return $this->belongsTo('App\Models\Pharmacy');
    }
    public function status()
    {
        return $this->belongsTo('App\Models\status');
    }
}
