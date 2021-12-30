<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'department_name', 'status',
    ];

    public function employee()
    {
        return $this->hasMany('App\Models\Employee');
    }

    public function team()
    {
        return $this->hasMany('App\Models\Team');
    }

    public function job()
    {
        return $this->hasMany('App\Models\Job');
    }
}
