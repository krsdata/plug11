<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class PrizeDistribution extends Eloquent
{

   
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'prize_distributions';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    /**
    * The primary key used by the model.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

     protected $hidden = [
        'id', 'created_at','updated_at'
    ];
    

    protected $guarded = ['created_at' , 'updated_at' , 'id' ];

    
     
    
}
