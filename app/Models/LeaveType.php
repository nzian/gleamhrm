<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    protected $fillable = [
        'name', 'amount', 'status',
    ];

    public function employees()
    {
        return $this->belongsToMany('App\Models\Employee')
            ->withTimestamps();
    }
}
