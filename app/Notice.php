<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'image', 'created_by', 'updated_by'];

    public function creator()
    {
        return $this->belongsTo(Employee::class, 'created_by', 'id');
    }

    public function updatetor()
    {
        return $this->belongsTo(Employee::class, 'updated_by', 'id');
    }
}