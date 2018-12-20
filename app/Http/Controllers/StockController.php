<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Stock;
use App\Product;
use Auth;
use DB;
use Illuminate\Support\Facades\Input;

class StockController extends Controller {

    public function listStock() {
        $stocks = Stock::select('product_id', DB::raw('sum(quantity) as quantity'))
                ->groupBy('product_id')
                
                ->where('stock_owner', Auth::user()->unit_id())
                ->where('is_usable', true)
                ->get();
        $unusable_stocks = Stock::select('product_id', DB::raw('sum(quantity) as quantity'))
                ->groupBy('product_id')
                
                ->where('stock_owner', Auth::user()->unit_id())
                ->where('is_usable', false)
                ->get();
        $view = view('stock/list_stock', compact('stocks', 'unusable_stocks'));
        return $view;
    }
    
    public function listStockSub() {
        $product_stocks = Stock::select('product_id', DB::raw('sum(quantity) as quantity'))
                ->groupBy('product_id')
                ->where('stock_owner', Auth::user()->unit_id())
                ->get();
        $individual_stocks = Stock::where('stock_owner', Auth::user()->unit_id())->get();
        $view = view('stock/list_stock_sub');
        $view->with('heading', 'Stock List');
        $view->with('product_stocks', $product_stocks);
        $view->with('individual_stocks', $individual_stocks);
        return $view;
    }

    public function addStock() {
        $stocks = Stock::where('stock_owner', Auth::user()->unit_id())->get();
        $stock = Stock::orderBy('updated_at', 'desc')->first();
        $products = Product::where('publication_status', true)->get();
        $view = view('stock/add_stock');
        $view->with('heading', 'Add Stock');
        $view->with('products', $products);
        $view->with('stocks', $stocks);
        $view->with('stock', $stock);
        return $view;
    }

    public function saveStock(Request $request) {
        $this->validate($request, [
            'product_id' => 'required',
            'price' => 'required',
            'attach_file' => 'max:200',
            'date' => 'required',
        ]);
        //custom validation for serial and quantity
        if (Product::find($request->product_id)->has_serial) {
            $this->validate($request, [
                'serial' => 'required|unique:stocks',
            ]);
        }else{
            $this->validate($request, [
                'quantity' => 'required',
            ]);
        }
        $stock = new Stock;
        $stock->fill($request->input());
        if (Input::hasFile('attach_file')) {
            $file = Input::file('attach_file');
            $file_name = 'uploads/' . time() . $file->getClientOriginalName();
            $file->move('uploads', $file_name);
            $stock->file_name = $file_name;
        }
        if (Product::find($request->product_id)->has_serial) {
            $stock->quantity = 1;
        }
        $stock->stock_owner = Auth::user()->unit_id();
        $stock->created_by = Auth::id();
        $stock->save();
        Session::put('alert-success', 'New item has saved!');
        return redirect()->back();
    }

    public function editStock($id) {
        $products = Product::where('publication_status', true)->get();
        $stock = Stock::find($id);
        $view = view('stock/edit_stock');
        $view->with('heading', 'Edit Stock');
        $view->with('stock', $stock);
        $view->with('products', $products);
        return $view;
    }

    public function updateStock(Request $request, $id) {
        $this->validate($request, [
            'product_id' => 'required',
            'price' => 'required',
            'attach_file' => 'max:200',
        ]);
        $stock = Stock::find($id);
        if (file_exists($stock->file_name)) {
            unlink($stock->file_name);
        }
        $stock->file_name = null;
        $stock->fill($request->all());
        if (Input::hasFile('attach_file')) {
            $file = Input::file('attach_file');
            $file_name = 'uploads/' . time() . $file->getClientOriginalName();
            $file->move('uploads', $file_name);
            $stock->file_name = $file_name;
        }
        $stock->updated_by = Auth::id();
        $stock->update();
        Session::put('alert-success', 'item has updated!');
        return redirect()->route('add_stock');
    }

    public function unpublishStock($id) {
        $stock = Stock::find($id);
        $stock->publication_status = false;
        $stock->update();
        return redirect()->back();
    }

    public function publishStock($id) {
        $stock = Stock::find($id);
        $stock->publication_status = true;
        $stock->update();
        return redirect()->back();
    }

    public function deleteStock($id) {
        $stock = Stock::find($id);
        $stock->deletation_status = TRUE;
        $stock->update();
        Session::put('alert-success', 'Item has deleted!');
        return redirect()->back();
    }

}
