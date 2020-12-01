<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EWalletAccountStatus extends Model
{
    // User account status
    const VERIFIED_ACCOUNT = 'verified';
    const UNVERIFIED_ACCOUNT = 'unverified';
    const SUSPENDED_ACCOUNT = 'suspended';
    const DEACTIVATED_ACCOUNT = 'deactivated';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'color'
    ];
    
    public function eWalletAccounts()
    {
        return $this->hasMany('App\Models\EWalletAccounts');
    }
}
