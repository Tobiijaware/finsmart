<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
   

    protected $fillable = [
        'bid', 'userid', 'ref', 'amount', 'rate', 'interest', 'prorate', 
        'profee', 'tranch','tenure', 'start', 'stop', 'mm',
        'terminate', 'status', 'type', 'rep'
    ];

    protected $table = 'invacc';
}
