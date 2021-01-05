<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flexible extends Model
{
   protected $fillable = [
    'bid', 'userid', 'status', 'l1', 'l2', 'l3', 'l4', 'l5','l6',
    's1','s2','s3','s4','i1','i2','i3','i4','i5','rep','ctime','o1','o2',
    'o3','o4','o5','o6'
   ];
   protected $table='flexible';
}
