<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Demand extends Model {

    use SoftDeletes;
    protected $fillable = [
        'demand_no',
        'unit_id',
        'date',
    ];

    public function demand_items() {
        return $this->belongsTo('App\DemandItem', 'id', 'demand_id');
    }

    public function demand_approval() {
        return $this->belongsTo('App\DemandApproval', 'id', 'demand_id');
    }
    public function demand_distribution() {
        return $this->belongsTo('App\DistributionMain', 'id', 'demand_id');
    }

    public function unit() {
        return Unit::find($this->unit_id);
    }

    public function has_approved() {
        if ($this->demand_approval()->first()) {
            return true;
        } else {
            return false;
        }
    }
    public function has_distributed() {
        if ($this->demand_distribution()->first()) {
            return true;
        } else {
            return false;
        }
    }

}
