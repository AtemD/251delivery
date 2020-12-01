<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EWalletAccount extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'number', 'user_id', 'balance', 'is_active', 'e_wallet_account_status_id', 'status_by', 'currency_id'
    ];

    public function eWalletAccountStatus()
    {
        return $this->belongsTo('App\Models\EWalletAccountStatus');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
