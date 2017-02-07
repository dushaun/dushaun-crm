<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobStatus extends Model
{
    public function jobs()
    {
        return $this->hasMany(Job::class, 'job_status');
    }
}
