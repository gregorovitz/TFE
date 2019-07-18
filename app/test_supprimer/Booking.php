<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'communication','total','organisationId', 'eventId', 'created_at','payement','validate'
    ];
    public function events()
    {
        return $this->belongsTo('App\Events');
    }
    public function organisation()
    {
        return $this->belongsTo('App\Organisation');
    }
}
