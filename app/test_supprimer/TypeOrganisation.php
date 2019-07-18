<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeOrganisation extends Model
{
    protected $fillable = [
        'name'
    ];
    protected $table='typeorganisations';
    public function organisation()
    {
        return $this->hasMany('App\Organisation');
    }
}
