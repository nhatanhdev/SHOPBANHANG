<?php

namespace App\Policies;

use App\Models\InfrastructureWard;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InfrastructureWardPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\InfrastructureWard  $infrastructureWard
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.infrastructureWard-list'));

    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.infrastructureWard-add'));
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\InfrastructureWard  $infrastructureWard
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.infrastructureWard-edit'));
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\InfrastructureWard  $infrastructureWard
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.infrastructureWard-delete'));
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\InfrastructureWard  $infrastructureWard
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, InfrastructureWard $infrastructureWard)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\InfrastructureWard  $infrastructureWard
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, InfrastructureWard $infrastructureWard)
    {
        //
    }
}
