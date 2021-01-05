<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product', 'type', 'min', 'max', 'interest', 'vat', 
        'profee', 'penalty', 'advisory', 'insurance', 'collateral', 'status', 'rep'
    ];
    
    protected $table = 'productsetup';
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
   
}
