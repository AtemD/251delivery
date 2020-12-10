<?php

namespace App\Policies;

use App\User;
use App\Models\Shop;
use App\Models\Permission;
use Illuminate\Auth\Access\HandlesAuthorization;

class ShopPolicy
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
        if(!$user->can(Permission::ACCESS_ADMINISTRATOR_DASHBOARD)) return false;

        return $user->can(Permission::VIEW_SHOPS);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Shop  $shop
     * @return mixed
     */
    public function view(User $user, Shop $shop)
    {
        return $user->can(Permission::VIEW_SHOPS) && $user->shops->contains($shop->id);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can(Permission::CREATE_SHOPS);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Shop  $shop
     * @return mixed
     */
    public function update(User $user, Shop $shop)
    {
        if(!$user->can(Permission::UPDATE_SHOPS)) return false;

        // if the user has permission to access admin dashboard,
        // they do not need to own the shop
        if($user->can(Permission::ACCESS_ADMINISTRATOR_DASHBOARD)
            || $user->shops->contains($shop->id)){
                return true;
        }

        // return $user->can(Permission::UPDATE_SHOPS) && $user->shops->contains($shop->id);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Shop  $shop
     * @return mixed
     */
    public function delete(User $user, Shop $shop)
    {
        return $user->can(Permission::DELETE_SHOPS) && $user->shops->contains($shop->id);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Shop  $shop
     * @return mixed
     */
    public function restore(User $user, Shop $shop)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Shop  $shop
     * @return mixed
     */
    public function forceDelete(User $user, Shop $shop)
    {
        //
    }
}
