<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EarningReport extends Model
{  
    /**
     * NOTE: 
     * ... A shop has its earnings report
     * ... The company also has its earnings report
     * ... The delivery driver also has his earnings report
     */

    // ......................................................
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'name', 'description', 'color'
    // ];

    public function shops()
    {
        $this->belongsTo('App\Models\Shop');
    }
}
