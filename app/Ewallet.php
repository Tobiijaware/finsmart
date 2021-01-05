<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ewallet extends Model
{
    protected $table = 'ewallet';
    protected $fillable = [
                'trno',
                'bid',
                'userid',
                'cos',
                'ctime',
                'mm',
                'status',
                'type',
                'remark',
                'rep',
                'opt',
                'mark',
                'ref',
                'ref2'
    ] ;
}
