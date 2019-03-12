<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Secteur extends Model
{
    protected $fillable=[
        'name'
    ];
    public function intern()
    {
        return $this->hasMany('App\EventIntern');
    }

}
