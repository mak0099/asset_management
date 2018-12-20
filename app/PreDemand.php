<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class PreDemand extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'product_id',
        'quantity',
        'logical_brief',
        'distribution',
    ];
    public function product(){
        return Product::find($this->product_id);
    }
    public function stock(){
        return Stock::where('product_id', $this->product_id)->where('stock_owner', Auth::user()->unit_id())->sum('quantity');
    }
    public function quantity_with_unit(){
        return $this->quantity . ' ' . $this->product()->product_unit;
    }
    public function stock_with_unit(){
        return $this->stock() . ' ' . $this->product()->product_unit;
    }
}
