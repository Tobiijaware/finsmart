<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = [
        'bid', 'userid', 'ref', 'amount', 'rate', 'interest', 'prorate', 
        'advisory', 'insurance', 'tranch', 'tenure', 'start', 'stop', 'mm',
        'terminate', 'status', 'type', 'rep'
    ];

    protected $table = 'loan';

}
