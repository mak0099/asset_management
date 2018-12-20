<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
class DemandItem extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'product_id',
        'quantity',
        'logical_brief',
        'distribution',
        'created_by',
    ];
    public function demand() {
        return $this->belongsTo('App\Demand', 'demand_id', 'id');
    }
    public function product(){
        return Product::find($this->product_id);
    }
    public function stocks(){
        return Stock::where('product_id', $this->product_id);
    }
    public function approved_item(){
        return $this->demand()->first()->demand_approval()->first()->demand_approval_items()->where('product_id', $this->product_id)->first();
    }
    public function stock(){
        return Stock::where('product_id', $this->product_id)->where('stock_owner', Auth::user()->unit_id())->sum('quantity');
    }
    public function demand_stock(){
        return Stock::where('product_id', $this->product_id)->where('stock_owner', $this->demand()->first()->unit_id)->sum('quantity');
    }
    public function main_stock(){
        return Stock::where('product_id', $this->product_id)->where('stock_owner', 1)->sum('quantity');
    }

}
