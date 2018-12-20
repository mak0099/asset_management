<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\ProductCategory;
use Auth;

class ProductCategoryController extends Controller {

    public function listProductCategory() {
        $product_categories = ProductCategory::all();
        $view = view('product_category/list_product_category');
        $view->with('heading', 'ProductCategory List');
        $view->with('product_categories', $product_categories);
        return $view;
    }

    public function addProductCategory() {
        $view = view('product_category/add_product_category');
        $view->with('heading', 'Add Product Category');
        return $view;
    }

    public function saveProductCategory(Request $request) {
        $this->validate($request, [
            'category_name' => 'required|unique:product_categories,category_name,NULL,id,deleted_at,NULL',
        ]);
        $product_category = new ProductCategory;
        $product_category->fill($request->input());
        $product_category->created_by = Auth::id();
        $product_category->save();
        Session::put('alert-success', 'New item has saved!');
        return redirect()->back();
    }

    public function editProductCategory($id) {
        $product_category = ProductCategory::findOrFail($id);
        $view = view('product_category/edit_product_category');
        $view->with('heading', 'Edit ProductCategory');
        $view->with('product_category', $product_category);
        return $view;
    }

    public function updateProductCategory(Request $request, $id) {
        $this->validate($request, [
            'category_name' => 'required|unique:product_categories,id,{$id}',
        ]);
        $product_category = ProductCategory::findOrFail($id);
        $product_category->fill($request->all());
        $product_category->updated_by = Auth::id();
        $product_category->update();
        Session::put('alert-success', 'item has updated!');
        return redirect()->route('list_product_category');
    }

    public function unpublishProductCategory($id) {
        $product_category = ProductCategory::find($id);
        $product_category->publication_status = false;
        $product_category->update();
        return redirect()->back();
    }

    public function publishProductCategory($id) {
        $product_category = ProductCategory::find($id);
        $product_category->publication_status = true;
        $product_category->update();
        return redirect()->back();
    }

    public function deleteProductCategory($id) {
        ProductCategory::findOrFail($id)->delete();
        Session::put('alert-success', 'Item has deleted!');
        return redirect()->back();
    }

}
