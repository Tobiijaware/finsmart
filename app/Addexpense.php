<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Addexpense extends Model
{
    protected $fillable = [
        'bid',
        'user_id',
        'amount',
        'des',
        'ctime',
        'cat_sn'
    ];

    protected $table = 'expenses';
}
