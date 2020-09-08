<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Models\Permission;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $guard_name = 'web';
    protected $table = 'users';
    
    // User account status
    const VERIFIED_USER = 'verified';
    const UNVERIFIED_USER = 'unverified';
    const DEACTIVATED_USER = 'deactivated';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'phone_number', 'email', 'password', 'user_account_status_id', 'status_by', 'status_date',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userAccountStatus()
    {
        return $this->belongsTo('App\Models\UserAccountStatus');
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function shops()
    {
        return $this->belongsToMany('App\Models\Shop', 'shop_has_users', 'user_id', 'shop_id');
    }

    public function getAllPermissionsAttribute()
    {
        return Auth::user()->getAllPermissions()->pluck('name')->toArray();
    }
}
