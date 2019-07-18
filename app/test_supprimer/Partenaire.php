<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partenaire extends Model
{
    protected $fillable=[
        'nom'
    ];

    public function interne()
    {
        return $this->belongsToMany('App\EventIntern','interne_has_partenaire','partenaireId','interneId');
    }
}
