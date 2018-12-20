<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DistributionMain extends Model
{
    use SoftDeletes;
    public function distribution_items(){
        return $this->belongsTo('App\DistributionMainItem', 'id', 'distribution_id');
    }
}
