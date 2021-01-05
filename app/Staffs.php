<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staffs extends Model
{
    protected $table='staffs';

    protected $fillable= [
        'userid','bid','rep','staffrole','payroll','status'
    ];
}
