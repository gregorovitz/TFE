<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
{
    protected $fillable = [
        'name'
    ];
    public function user()
    {
        return $this->hasMany('App\User');
    }
    public function booking()
    {
        return $this->hasMany('App\Booking');
    }
}
