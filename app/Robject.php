<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Robject extends Model
{
    protected $fillable = [
        'userid', 'bid', 'obj', 'ref', 'email', 'status'
    ];
    
    protected $table = 'robject';
}
