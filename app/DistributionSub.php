<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DistributionSub extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'stock_id',
        'employee_id',
        'date',
    ];
    public function employee(){
        return Employee::find($this->employee_id);
    }
    public function stock(){
        return Stock::find($this->stock_id);
    }
    public function unit(){
        return Unit::find($this->unit_id);
    }
}
