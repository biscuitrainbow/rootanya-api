<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $guarded = [];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function notifications()
    {
        return $this->hasMany(UserHasNotification::class, 'medicines_id');
    }
}
