<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    protected $fillable=[
       'userId','typeEventsId','roomId','bookingId','event_name','start_date','end_date','numPeopleExp','numPeopleActuCame','daysofweek','startime','endtime','color'
    ];
    public function booking()
    {
        return $this->belongsTo('App\Booking','bookingId');
    }
    public function room()
    {
        return $this->belongsTo('App\Room','roomId');
    }
    public function type()
    {
        return $this ->belongsTo('App\TypeEvents','typeEventsId');
    }
    public function user()
    {
        return $this->belongsTo('App\User','userId');
    }
    public function interne()
    {
        return $this->hasOne('App\EventIntern','eventId');
    }
}
