<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebProduct extends Model
{
    public function jobs()
    {
        return $this->hasMany(Job::class, 'product');
    }
}
