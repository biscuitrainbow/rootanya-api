<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

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
        'password', 'remember_token',
    ];


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
