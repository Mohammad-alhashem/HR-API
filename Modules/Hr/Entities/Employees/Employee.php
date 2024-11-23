<?php

namespace Modules\Hr\Entities\Employees;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{

    protected $table        = 'employees';
    protected $fillable     = [
        'first_name',
        'last_name',
        'email'
    ];

}