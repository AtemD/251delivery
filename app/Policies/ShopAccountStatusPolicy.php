<?php

namespace App\Policies;

use App\User;
use App\Models\ShopAccountStatus;
use App\Models\Permission;
use Illuminate\Auth\Access\HandlesAuthorization;

class ShopAccountStatusPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->can(Permission::VIEW_SHOP_ACCOUNT_STATUSES);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can(Permission::CREATE_SHOP_ACCOUNT_STATUSES);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->can(Permission::UPDATE_SHOP_ACCOUNT_STATUSES);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->can(Permission::DELETE_SHOP_ACCOUNT_STATUSES);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Models\ShopAccountStatus  $shop_account_status
     * @return mixed
     */
    public function restore(User $user, ShopAccountStatus $shop_account_status)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Models\ShopAccountStatus  $shop_account_status
     * @return mixed
     */
    public function forceDelete(User $user, ShopAccountStatus $shop_account_status)
    {
        //
    }
}
