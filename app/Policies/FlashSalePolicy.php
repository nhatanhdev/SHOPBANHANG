<?php

namespace App\Policies;

use App\Models\FlashSale;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FlashSalePolicy
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
     * @param  \App\Models\FlashSale  $flashSale
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.flashSale-list'));

    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.flashSale-add'));

    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FlashSale  $flashSale
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.flashSale-edit'));

    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FlashSale  $flashSale
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.flashSale-delete'));

    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FlashSale  $flashSale
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, FlashSale $flashSale)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FlashSale  $flashSale
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, FlashSale $flashSale)
    {
        //
    }
}
