<?php

namespace App\Policies;

use App\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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
        return $user->can(Permission::VIEW_USERS);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can(Permission::CREATE_USERS);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function update(User $user)
    {
        // Get the authenticated user
        $auth_user = Auth::user();

        // All users can update their own account
        if($user->id === $auth_user->id){
            return true;
        }

        // Else you are updating another user who is not you,
        // The retailer and admin are allowed to do this in different ways as below

        // The authenticated user should have permission to update users to proceed
         if(!$auth_user->can(Permission::UPDATE_USERS)) return false;


        // For normal authenticated users without any role...
        if(!$auth_user->hasAnyRole([Role::RETAILER, Role::ADMINISTRATOR, Role::RIDER])){
            // If the user you are updating has any role, then you can't update that user
            if($user->hasAnyRole([Role::RETAILER, Role::ADMINISTRATOR, Role::RIDER])) return false;

            // otherwise, you can update a user without roles
            return true;
        }

        // Determine if the authenticated user is a retailer only and not an admin
        if($auth_user->hasRole(Role::RETAILER) && ! $auth_user->hasRole(Role::ADMINISTRATOR)){

            // If user you are updating has role of admin, or permission to access admin dashboard, return false
            // since a retailer cannot edit admin user,
            if($user->hasRole(Role::ADMINISTRATOR) || $user->hasPermissionTo(Permission::ACCESS_ADMINISTRATOR_DASHBOARD)){
                return false;
            }

            // check if the user submitted is assigned to the retailers shop
            $retailer_shops = $auth_user->shops()->get()->pluck('id');
            $user_shops = $user->shops()->get()->pluck('id');

            $have_same_shop = false;
            foreach($retailer_shops as $shop_id){
                if($user_shops->contains($shop_id)){
                    $have_same_shop = true;
                }
            }

            // if user has same shop as retailer, then retailer can update the user
            if($have_same_shop){
                return true;
            } else {
                return false;
            } 
            
        }

        // If the user is admin, they can update any users
        if($auth_user->hasRole(Role::ADMINISTRATOR) || $auth_user->hasPermissionTo(Permission::ACCESS_ADMINISTRATOR_DASHBOARD)){
            return true;
        }
        
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function delete(User $user)
    {
        // Get the authenticated user
        $auth_user = Auth::user();

        // All users can delete their own account
        if($user->id === $auth_user->id){
            return true;
        }

        // Else you are deleting another user who is not you,
        // The retailer and admin are allowed to do this in different ways as below

        // The authenticated user should have permission to delete users to proceed
         if(!$auth_user->can(Permission::DELETE_USERS)) return false;


        // For normal authenticated users without any role...
        if(!$auth_user->hasAnyRole([Role::RETAILER, Role::ADMINISTRATOR, Role::RIDER])){
            // If the user you are updating has any role, then you can't delete that user
            if($user->hasAnyRole([Role::RETAILER, Role::ADMINISTRATOR, Role::RIDER])) return false;

            // otherwise, you can update a user without roles
            return true;
        }

        // Determine if the authenticated user is a retailer only and not an admin
        if($auth_user->hasRole(Role::RETAILER) && ! $auth_user->hasRole(Role::ADMINISTRATOR)){

            // If user you are deleting has role of admin, or permission to access admin dashboard, return false
            // since a retailer cannot edit admin user,
            if($user->hasRole(Role::ADMINISTRATOR) || $user->hasPermissionTo(Permission::ACCESS_ADMINISTRATOR_DASHBOARD)){
                return false;
            }

            // check if the user submitted is assigned to the retailers shop
            $retailer_shops = $auth_user->shops()->get()->pluck('id');
            $user_shops = $user->shops()->get()->pluck('id');

            $have_same_shop = false;
            foreach($retailer_shops as $shop_id){
                if($user_shops->contains($shop_id)){
                    $have_same_shop = true;
                }
            }

            // if user has same shop as retailer, then retailer can delete the user
            if($have_same_shop){
                return true;
            } else {
                return false;
            } 
            
        }

        // If the user is admin, they can update any users
        if($auth_user->hasRole(Role::ADMINISTRATOR) || $auth_user->hasPermissionTo(Permission::ACCESS_ADMINISTRATOR_DASHBOARD)){
            return true;
        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Tax  $tax
     * @return mixed
     */
    public function restore(User $user, Tax $tax)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Tax  $tax
     * @return mixed
     */
    public function forceDelete(User $user, Tax $tax)
    {
        //
    }
}
