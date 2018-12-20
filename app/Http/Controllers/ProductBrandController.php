<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\ProductBrand;
use Auth;

class ProductBrandController extends Controller {

    public function listProductBrand() {
        $product_brands = ProductBrand::all();
        $view = view('product_brand/list_product_brand');
        $view->with('heading', 'ProductBrand List');
        $view->with('product_brands', $product_brands);
        return $view;
    }

    public function addProductBrand() {
        $view = view('product_brand/add_product_brand');
        $view->with('heading', 'Add Product Brand');
        return $view;
    }

    public function saveProductBrand(Request $request) {
        $this->validate($request, [
            'brand_name' => 'required|unique:product_brands,brand_name,NULL,id,deleted_at,NULL',
        ]);
        $product_brand = new ProductBrand;
        $product_brand->fill($request->input());
        $product_brand->created_by = Auth::id();
        $product_brand->save();
        Session::put('alert-success', 'New item has saved!');
        return redirect()->back();
    }

    public function editProductBrand($id) {
        $product_brand = ProductBrand::findOrFail($id);
        $view = view('product_brand/edit_product_brand');
        $view->with('heading', 'Edit ProductBrand');
        $view->with('product_brand', $product_brand);
        return $view;
    }

    public function updateProductBrand(Request $request, $id) {
        $this->validate($request, [
            'brand_name' => 'required|unique:product_brands,id,{$id}',
        ]);
        $product_brand = ProductBrand::findOrFail($id);
        $product_brand->fill($request->all());
        $product_brand->updated_by = Auth::id();
        $product_brand->update();
        Session::put('alert-success', 'item has updated!');
        return redirect()->route('list_product_brand');
    }

    public function unpublishProductBrand($id) {
        $product_brand = ProductBrand::find($id);
        $product_brand->publication_status = false;
        $product_brand->update();
        return redirect()->back();
    }

    public function publishProductBrand($id) {
        $product_brand = ProductBrand::find($id);
        $product_brand->publication_status = true;
        $product_brand->update();
        return redirect()->back();
    }

    public function deleteProductBrand($id) {
        ProductBrand::findOrFail($id)->delete();
        Session::put('alert-success', 'Item has deleted!');
        return redirect()->back();
    }

}
