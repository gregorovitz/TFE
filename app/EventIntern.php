<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\StoreEventInterneRequest;
class EventIntern extends Model
{
    protected $table='eventintern';
    protected $fillable=[
        'evaluation','age','programme','participant','budget','secteurId','eventId'
    ];
    public function event()
    {
        return $this->belongsTo('App\Events','eventId');
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
