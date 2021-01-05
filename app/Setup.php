<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setup extends Model
{
    protected $fillable = [
        'bid','userid', 'phone', 'phone2','email','status', 'company','address', 'address2', 'accname',
         'bank', 'accno','bank2','accno2','accname','senderid'
    ];

    protected $table='setup';
}
