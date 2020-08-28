<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAccountStatus extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'color'
    ];
    
    public function users()
    {
        return $this->hasMany('App\User');
    }
}
