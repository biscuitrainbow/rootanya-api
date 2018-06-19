<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    
    public function notifications(){
       return $this->hasMany(UserHasNotification::class,'medicines_id');
    }
}
