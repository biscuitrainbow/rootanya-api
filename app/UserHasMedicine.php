<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserHasMedicine extends Model
{
    protected $table = 'medicines_has_users';

    protected $guarded = [];
}
