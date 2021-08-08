<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usertoken extends Model
{
    use HasFactory;

    protected $fillable = [
        'token',
        'user_id',
        'push',
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
