<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'employee_name',
        'employee_id',
        'designation',
        'phone',
        'email',
        'address',
        'unit_id',
    ];
    
    public function unit(){
        return Unit::find($this->unit_id);
    }
}
