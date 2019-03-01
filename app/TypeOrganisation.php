<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeOrganisation extends Model
{
    protected $fillable = [
        'name'
    ];
    public function organisation()
    {
        return $this->belongsToMany('App\Organisation');
    }
}
