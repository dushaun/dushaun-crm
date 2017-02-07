<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public function clients()
    {
        return $this->hasMany(Client::class, 'subscription');
    }
}
