<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
{
    protected $fillable = [
        'name'
    ];
    public function user()
    {
        return $this->belongsToMany('App\User','organisation_has_user','organisationId','userId');
    }
    public function type()
    {
        return $this->belongsToMany('App\TypeOrganisation','organisation_has_type','organisationId','typeOrganisationId');
    }
}
