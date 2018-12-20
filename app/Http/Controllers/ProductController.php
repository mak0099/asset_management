<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Product;
use Auth;
use DB;

class ProductController extends Controller {
    public function listProduct() {
        $view = view('product/list_product');
        $view->with('heading', 'Product List');
        $view->with('products', Product::get_products());
        return $view;
    }

    public function addProduct() {
        $view = view('product/add_product');
        $view->with('product_categories', \App\ProductCategory::all());
        $view->with('product_brands', \App\ProductBrand::all());
        $view->with('heading', 'Add Product');
        return $view;
    }

    public function saveProduct(Request $request) {
        $this->validate($request, [
            'product_name' => 'required',
            'has_serial' => 'required',
        ]);
        $product = new Product;
        $product->fill($request->input());
        if($request->has_serial){
            $product->product_unit = 'piece';
        }
        $product->created_by = Auth::id();
        $product->save();
        Session::put('alert-success', 'New item has saved!');
        return redirect()->back();
    }

    public function editProduct($id) {
        $product = Product::find($id);
        $view = view('product/edit_product');
        $view->with('product_categories', \App\ProductCategory::all());
        $view->with('product_brands', \App\ProductBrand::all());
        $view->with('heading', 'Edit Product');
        $view->with('product', $product);
        return $view;
    }

    public function updateProduct(Request $request, $id) {
        $this->validate($request, [
            'product_name' => 'required',
            'has_serial' => 'required',
        ]);
        $product = Product::find($id);
        $product->fill($request->all());
        if($request->has_serial){
            $product->product_unit = 'piece';
        }
        $product->updated_by = Auth::id();
        if ($product->update()) {
            Session::put('alert-success', 'item has updated!');
            return redirect()->route('list_product');
        } else {
            Session::put('alert-danger', 'Something went wrong!');
            return redirect()->back();
        }
    }

    public function viewProduct($id) {
        $view = view('product/view_product');
        $view->with('product', Product::find_product($id));
        return $view;
    }

    public function unpublishProduct($id) {
        $product = Product::find($id);
        $product->publication_status = false;
        $product->update();
        return redirect()->back();
    }

    public function publishProduct($id) {
        $product = Product::find($id);
        $product->publication_status = true;
        $product->update();
        return redirect()->back();
    }

    public function deleteProduct($id) {
        Product::findOrFail($id)->delete();
        Session::put('alert-success', 'Item has deleted!');
        return redirect()->back();
    }

}
