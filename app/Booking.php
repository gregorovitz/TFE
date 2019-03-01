<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'amount', 'guarantee', 'created_at'
    ];
    public function events()
    {
        return $this->belongsToMany('App\Events');
    }
    public function room()
    {
        return $this->belongsToMany('App\Room');
    }
}
