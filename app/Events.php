<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    protected $fillable=[
       'userId','typeEventsId','roomId','bookingId','event_name','start_date','end_date','numPeopleExp','numPeopleActuCame','daysofweek','startime','endtime','color'
    ];

    public function room()
    {
        return $this->belongsTo('App\Room','roomId');
    }

    public function user()
    {
        return $this->belongsTo('App\User','userId');
    }
    public function organisation()
    {
        return $this->belongsTo('App\Organisation','organisationId');
    }

}
