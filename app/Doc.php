<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doc extends Model
{
    protected $fillable = [
        'userid', 'bid', 'title', 'doc', 'note', 'rep' 
        
    ];

    protected $table = 'doc';
}
