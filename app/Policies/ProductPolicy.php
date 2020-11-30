<?php

namespace App\Policies;

use App\User;
use App\Models\Shop;
use App\Models\Product;
use App\Models\Permission;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
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
        return $user->can(Permission::VIEW_PRODUCTS);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can(Permission::CREATE_PRODUCTS);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param \App\Product $product 
     * @return mixed
     */
    public function update(User $user, Product $product)
    {
        // Get the shop the product belongs to 
        $shop = $product->shop()->firstOrFail();

        // get all the users of the retrieved shop
        $shop_owners = $shop->users()->get()->pluck('id');

        // check if the user is among shop owners and has the appropriate permission
        if( $shop_owners->contains($user->id) && 
            $user->can(Permission::UPDATE_PRODUCTS)
           )
        {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Product  $product
     * @return mixed
     */
    public function delete(User $user, Product $product)
    {
         // Get the shop the product belongs to 
         $shop = $product->shop()->firstOrFail();

         // get all the users of the retrieved shop
         $shop_owners = $shop->users()->get()->pluck('id');
 
         // check if the user is among shop owners and has the appropriate permission
         if( $shop_owners->contains($user->id) && 
             $user->can(Permission::DELETE_PRODUCTS)
            )
         {
             return true;
         } else {
             return false;
         }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function restore(User $user)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        //
    }
}
