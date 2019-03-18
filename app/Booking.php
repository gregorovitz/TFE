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
        return $this->belongsToMany('App\Events','event_has_booking','bookingId','eventId');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
