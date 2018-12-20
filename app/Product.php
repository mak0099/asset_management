<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model {

    use SoftDeletes;
    protected $fillable = [
        'product_name',
        'model_no',
        'brand_id',
        'category_id',
        'has_serial',
        'product_unit',
    ];
    public static function get_products(){
        return Product::select('products.*', 'product_brands.brand_name', 'product_categories.category_name')
                ->leftJoin('product_brands', 'products.brand_id', 'product_brands.id')
                ->leftJoin('product_categories', 'products.category_id', 'product_categories.id')->get();
    }
    public static function find_product($id){
        return Product::select('products.*', 'product_brands.brand_name', 'product_categories.category_name')
                ->leftJoin('product_brands', 'products.brand_id', 'product_brands.id')
                ->leftJoin('product_categories', 'products.category_id', 'product_categories.id')
                ->find($id);
    }
    public function brand(){
        return \App\ProductBrand::find($this->brand_id);
    }
    public function category(){
        return \App\ProductCategory::find($this->category_id);
    }
    public function product_with_brand() {
        if ($this->product_brand) {
            return $this->product_name . ' (' . $this->product_brand . ')';
        }else{
            return $this->product_name;
        }
    }
    

}
