<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public function lists()
    {
        return $this->hasMany(Lists::class);
    }
}
