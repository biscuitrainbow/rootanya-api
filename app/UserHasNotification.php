<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserHasNotification extends Model
{
    protected $table = 'users_has_notification';

    protected $guarded = [];

    public function medicines(){
        return $this->belongsTo(Medicine::class,'medicines_id');
    }
}
