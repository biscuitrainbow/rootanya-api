<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends \TCG\Voyager\Models\User
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','created_at','updated_at'
    ];

    public function medicines(){
        return $this->hasMany(Medicine::class, 'user_id');
    }


    public function notifications()
    {
        return $this->belongsToMany(Medicine::class, 'users_has_notification', 'users_id', 'medicines_id')->withPivot('uuid', 'at');
    }

    public function usages()
    {
        return $this->belongsToMany(Medicine::class, 'medicines_has_users', 'users_id', 'medicines_id')->withPivot('id', 'volume', 'created_at');
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class, 'users_id');
    }
}
