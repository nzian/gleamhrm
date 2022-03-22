<?php

namespace App\Policies;

use App\Employee;
use App\HandOverAsset;
use Illuminate\Auth\Access\HandlesAuthorization;

class HandOverAssetPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Employee $employee)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Employee  $employee
     * @param  \App\HandOverAsset  $handOverAsset
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Employee $employee, HandOverAsset $handOverAsset)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Employee $employee)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Employee  $employee
     * @param  \App\HandOverAsset  $handOverAsset
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Employee $employee, HandOverAsset $handOverAsset)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Employee  $employee
     * @param  \App\HandOverAsset  $handOverAsset
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Employee $employee, HandOverAsset $handOverAsset)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Employee  $employee
     * @param  \App\HandOverAsset  $handOverAsset
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Employee $employee, HandOverAsset $handOverAsset)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Employee  $employee
     * @param  \App\HandOverAsset  $handOverAsset
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Employee $employee, HandOverAsset $handOverAsset)
    {
        //
    }
}
