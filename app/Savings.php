<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Savings extends Model
{
    protected $fillable = [
        'bid', 'userid', 'ref', 'amount', 'rate', 'period', 
        'rate2',  'start', 'stop', 'mm', 'status', 'type', 'rep'
    ];

    protected $table = 'savings';
    public $primaryKey='userid';
}
