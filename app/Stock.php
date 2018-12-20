<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stock extends Model {
    use SoftDeletes;
    protected $fillable = [
        'committee_no',
        'procurement_date',
        'product_id',
        'price',
        'is_consumable',
        'is_usable',
        'date',
        'serial',
        'quantity',
    ];
    
    public function product() {
        return $this->belongsTo('App\Product');
    }
    public function distribution_sub() {
        return $this->belongsTo('App\DistributionSub', 'id', 'stock_id');
    }
    public function quantity_with_unit(){
        return $this->quantity . ' ' . $this->product()->first()->product_unit;
    }
}
