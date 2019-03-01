<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'name'
    ];
    public function booking()
    {
        return $this->belongsToMany('App\Booking');
    }
    public function events()
    {
        return $this->belongsToMany('App\Events');
    }
}
