<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
{
    protected $fillable = [
        'name'
    ];

    public function events()
    {
        return $this->hasMany('App\Events');
    }
}
