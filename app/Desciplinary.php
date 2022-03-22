<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desciplinary extends Model
{
    use HasFactory;

    protected $fillable = ['action', 'employee_id', 'team_id', 'title', 'description'];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}