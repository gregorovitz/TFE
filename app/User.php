<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','firstname','phone','street','streetNum','boxNum','cityId','created_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function city()
    {
        return $this->belongsTo('App\Cities','cityId','cityId');
    }
    public function organisation()
    {
        return $this->belongsTo('App\Organisation','organisationId','id');
    }
    public function Booking()
    {
        return $this->hasMany('App\Booking');
    }
    public function event()
    {
        return $this->hasMany('App\Events');
    }
    public function interne()
    {
        return $this->belongsToMany('App\EventInterne','interne_has_user','userId','interneId');
    }

}
