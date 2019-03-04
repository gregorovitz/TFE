<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'userId','name','amount', 'guarantee', 'created_at','userid'
    ];
    public function events()
    {
        return $this->hasOne('App\Events');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
