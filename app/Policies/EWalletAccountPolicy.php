<?php

namespace App\Policies;

use App\User;
use App\Models\EWalletAccount;
use App\Models\Permission;
use Illuminate\Auth\Access\HandlesAuthorization;

class EWalletAccountPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user, EWalletAccount $e_wallet_account)
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
        return $user->can(Permission::VIEW_E_WALLET_ACCOUNTS);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can(Permission::CREATE_E_WALLET_ACCOUNTS);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function update(User $user, EWalletAccount $e_wallet_account)
    {
        return $user->can(Permission::UPDATE_E_WALLET_ACCOUNTS);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function delete(User $user, EWalletAccount $e_wallet_account)
    {
        return $user->can(Permission::DELETE_E_WALLET_ACCOUNTS);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\EWalletAccount  $e_wallet_account
     * @return mixed
     */
    public function restore(User $user, EWalletAccount $e_wallet_account)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\EWalletAccount  $e_wallet_account
     * @return mixed
     */
    public function forceDelete(User $user, EWalletAccount $e_wallet_account)
    {
        //
    }
}
