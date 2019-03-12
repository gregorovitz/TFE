<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventIntern extends Model
{
    protected $table='eventintern';
    protected $fillable=[
        'evaluation','age','programme','participant','budget','secteurId'
    ];
    public function event()
    {
        return $this->hasOne('App\Events','bookingId');
    }
    public function secteur()
    {
        return $this->belongsTo('App\Secteur','secteurId');
    }
    public function animateurs()
    {
        return $this->belongsToMany('App\User','interne_has_user','interneId','userId');
    }
    public function partenaire()
    {
        return $this->belongsToMany('App\Partenaire','interne_has_partenaire','interneId','partenaireId');
    }
}
