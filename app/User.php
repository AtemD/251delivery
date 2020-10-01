<?php

namespace App;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Models\Permission;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasRoles, HasSlug;

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

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['first_name', 'last_name'])
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }
    
    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

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

    /*
     * We will use this attribute to get all user permissions
     * We will use it in vue, to obtain the user permissions
     */
    public function getAllPermissionsAttribute()
    {
        return Auth::user()->getAllPermissions()->pluck('name')->toArray();
    }
}
