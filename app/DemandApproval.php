<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DemandApproval extends Model
{
    use SoftDeletes;
    public function demand(){
        return Demand::find($this->demand_id);
    }
    public function demand_approval_items(){
        return $this->belongsTo('App\DemandApprovalItem', 'id', 'demand_approval_id');
    }
    public function getItemByProductId($product_id){
        return $this->demand_approval_items()->where('product_id', $product_id)->first();
    }
}
