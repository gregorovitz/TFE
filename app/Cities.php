<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    protected $fillable = [
        'zipCode', 'name', 'provinces'
    ];
    public function users()
    {
        return $this->hasMany('App\User');
    }
}
