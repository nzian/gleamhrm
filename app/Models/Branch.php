<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = [
        'name', 'status', 'address', 'phone_number', 'timing_start', 'timing_off', 'weekend',
    ];

    public function employee()
    {
        return $this->hasMany('App\Models\Employee');
    }

    public function job()
    {
        return $this->hasMany('App\Models\Job');
    }
}