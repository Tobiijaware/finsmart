<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected  $fillable = [
        'bid',
        'category',
        'userid'
    ];
    protected $table = 'category';
}

