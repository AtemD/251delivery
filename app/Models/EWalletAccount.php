<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EWalletAccount extends Model
{
    /**
     * We store the account balance in cents in the database,
     * This constants are also in cents,
     * We will do all money calculations in cents
     * The actual values (modified account balance) are only shown in the views,
     * 1000 Birr = 1000*100 = 100000 ETB in cents
     */
    const MAX_E_WALLET_ACCOUNT_BALANCE = '100000'; // This is equivalent to 1000 ETB though in cents
    const MIN_E_WALLET_ACCOUNT_BALANCE = '0'; // This is is equivalent to 0 ETB though in cents

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'number', 'user_id', 'balance', 'is_active', 'e_wallet_account_status_id', 'status_by', 'currency_id'
    ];

    protected $appends = ['modified_balance'];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'number';
    }

    /**
     * Set the e-wallet balance.
     *
     * @param  string  $value
     * @return void
     */
    public function setBalanceAttribute($value)
    {
        $this->attributes['balance'] = $value * 100;
    }

    /**
     * Get the modified balance
     *
     * @return string
     */
    public function getModifiedBalanceAttribute()
    {
        return $this->attributes['balance'] / 100;
    }

    public function eWalletAccountStatus()
    {
        return $this->belongsTo('App\Models\EWalletAccountStatus');
    }

    public function currency()
    {
        return $this->belongsTo('App\Models\Currency');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
