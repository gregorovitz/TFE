<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeEvents extends Model
{
    protected $fillable = [
        'name'
    ];
    protected $table='typeevents';
    public function event()
    {
        return $this->belongsToMany('App\Events','event_has_type','typeId','eventId');
    }
}
