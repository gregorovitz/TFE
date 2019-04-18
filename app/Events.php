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
        return $this->belongsToMany('App\Booking','event_has_booking','eventID','bookingId');
    }
    public function room()
    {
        return $this->belongsTo('App\Room','roomId');
    }
    public function type()
    {
        return $this ->belongsToMany('App\TypeEvents','event_has_type','eventId','typeId');
    }
    public function user()
    {
        return $this->belongsTo('App\User','userId');
    }
    public function interne()
    {
        return $this->hasOne('App\EventIntern','eventId');
    }
    public function organisation()
    {
        return $this->belongsTo('App\Organisation','organisationId');
    }
}
