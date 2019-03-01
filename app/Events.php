<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    protected $fillable=[
        'event_name','start_date','end_date','numPeopleExp','numPeopleActuCame','daysofweek','startime','endtime','color'
    ];
    public function booking()
    {
        return $this->belongsToMany('App\Booking');
    }
    public function room()
    {
        return $this->belongsToMany('App\Room');
    }
}
