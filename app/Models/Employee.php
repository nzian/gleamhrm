<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Employee extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use HasRoles;
    protected $guard_name = 'web';

    protected $dates = ['deleted_at'];
    protected $appends = ['full_name'];

    protected $fillable = [
        'firstname', 'department_id', 'lastname', 'contact_no', 'emergency_contact_relationship', 'emergency_contact', 'emergency_contact_address', 'password', 'official_email', 'personal_email', 'designation', 'status', 'employment_status', 'picture', 'exit_date', 'total_salary', 'bonus', 'gross_salary', 'identity_no', 'date_of_birth', 'current_address', 'permanent_address', 'city', 'joining_date', 'exit_date', 'branch_id', 'gender', 'deleted_at', 'created_at', 'updated_at',
    ];

    public function getFullNameAttribute()
    {
        return "{$this->firstname} {$this->lastname}";
    }

    public function branch()
    {
        return $this->belongsTo('App\Models\Branch', 'branch_id');
    }

    public function attendanceSummary()
    {
        return $this->hasMany('App\Models\AttendanceSummary')->latest();
    }

    public function attendanceSummaries()
    {
        return $this->hasMany('App\Models\AttendanceSummary');
    }

    public function salary()
    {
        return $this->hasOne(Salary::class, 'employee_id');
    }

    public function leaveTypes()
    {
        return $this->belongsToMany('App\Models\LeaveType')
            ->withPivot('status')
            ->withTimestamps();
    }

    public function isAllowed($permission)
    {
        $allowedLists = $this->getDirectPermissions()->pluck('name');

        if ($this->hasRole('admin')) {
            return 1;
        } else {
            foreach ($allowedLists as $allowedPermission) {
                if ($allowedPermission == $permission) {
                    return 1;
                }
            }
        }

        /*if(!$this->hasPermissionTo($permission)){
           return 0;
        }
        else{
            return 1;
        }*/
    }

    public function department()
    {
        return $this->belongsTo('App\Models\Department', 'department_id');
    }

    public function leaves()
    {
        return $this->hasMany('App\Models\Leave', 'employee_id');
    }
}
