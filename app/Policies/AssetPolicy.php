<?php

namespace App\Policies;

use App\Asset;
use App\Employee;
use Illuminate\Auth\Access\HandlesAuthorization;

class AssetPolicy
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
     * @param  \App\Asset  $asset
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Employee $employee, Asset $asset)
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
     * @param  \App\Asset  $asset
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Employee $employee, Asset $asset)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Employee  $employee
     * @param  \App\Asset  $asset
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Employee $employee, Asset $asset)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Employee  $employee
     * @param  \App\Asset  $asset
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Employee $employee, Asset $asset)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Employee  $employee
     * @param  \App\Asset  $asset
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Employee $employee, Asset $asset)
    {
        //
    }
}
