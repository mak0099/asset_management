<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Demand;
use App\DemandApproval;
use App\Employee;
use App\DistributionMain;
use App\DistributionSub;
use App\DistributionMainItem;
use App\Stock;
use Auth;
use Session;
use DB;

class DistributionController extends Controller {

    public function listDistributionMain() {
        $approved_demands = DemandApproval::orderBy('id', 'desc')->get();
        $view = view('distribution/list_distribution_main');
        $view->with('approved_demands', $approved_demands);
        return $view;
    }

    public function distributionMain($demand_no) {
        $demand = Demand::where('demand_no', $demand_no)->first();
        if (!$demand->has_approved()) {
            Session::put('alert-danger', 'Demand has not approved');
            return redirect()->back();
        }
        $demand_items = $demand->demand_items()->get();
        $employees = Employee::where('unit_id', $demand->unit_id)->get();
        $view = view('distribution/distribution_main');
        $view->with('demand', $demand);
        $view->with('demand_items', $demand_items);
        $view->with('employees', $employees);
        return $view;
    }

    public function saveDistributionMain($demand_id, Request $request) {
        $this->validate($request, [
            'distribution_date' => 'required',
            'employee_id' => 'required'
        ]);
        $demand_items = Demand::find($demand_id)->demand_items()->get();
//        validation
        foreach ($demand_items as $demand_item) {
            if ($demand_item->main_stock() < $demand_item->approved_item()->quantity) {
                Session::put('alert-danger', ' Item ' . $demand_item->product()->product_with_brand() . ' out of stock');
                return redirect()->back();
            }
            if ($demand_item->product()->has_serial) {
                $serial = $request->input($demand_item->product_id);
                if (count($serial) < $demand_item->approved_item()->quantity) {
                    Session::put('alert-danger', 'Serial field is required');
                    return redirect()->back();
                }
                if (count($serial) != count(array_unique($serial))) {
                    Session::put('alert-danger', 'duplicate serial found!');
                    return redirect()->back();
                }
                for ($i = 0; $i < count($serial); $i++) {
                    if (is_null($serial[$i])) {
                        Session::put('alert-danger', 'Serial field is required');
                        return redirect()->back();
                    }
                    $stock_main = Stock::where('stock_owner', 1)->where('serial', $serial[$i])->first();
                    if (!$stock_main) {
                        Session::put('alert-danger', 'Serial ' . $serial[$i] . ' not found in main Unit Stock');
                        return redirect()->back();
                    }
                }
            }
        }
        $distribution = new DistributionMain;
        $distribution->demand_id = $demand_id;
        $distribution->distribution_date = $request->distribution_date;
        $distribution->employee_id = $request->employee_id;
        $distribution->created_by = Auth::id();
        $distribution->save();
        foreach ($demand_items as $demand_item) {
            $distribution_item = new DistributionMainItem;
            $distribution_item->distribution_id = $distribution->id;
            $distribution_item->product_id = $demand_item->product_id;
            $distribution_item->quantity = $demand_item->approved_item()->quantity;
            $distribution_item->serial = serialize($request->input($demand_item->product_id));
            $distribution_item->save();
            if ($request->input($demand_item->product_id)) {
                $serial = $request->input($demand_item->product_id);
                for ($i = 0; $i < count($serial); $i++) {
                    $stock_main = Stock::where('serial', $serial[$i])->update([
                        'stock_owner' => $demand_item->demand()->first()->unit_id
                    ]);
                }
            } else {
                Stock::where('product_id', $demand_item->product_id)->where('stock_owner', 1)->update(['quantity' => DB::raw('quantity-' . $demand_item->approved_item()->quantity)]);
                $sub_stock = Stock::where('product_id', $demand_item->product_id)->where('stock_owner', $demand_item->demand()->first()->unit_id)->first();
                if ($sub_stock) {
                    $sub_stock->update([
                        'quantity' => DB::raw('quantity+' . $demand_item->approved_item()->quantity)
                    ]);
                } else {
                    $temp_stock = Stock::where('product_id', $demand_item->product_id)->first();
                    $up_stock = new Stock;
                    $up_stock->committee_no = $temp_stock->committee_no;
                    $up_stock->procurement_date = $temp_stock->procurement_date;
                    $up_stock->product_id = $temp_stock->product_id;
                    $up_stock->quantity = $demand_item->approved_item()->quantity;
                    $up_stock->price = $temp_stock->price;
                    $up_stock->is_consumable = $temp_stock->is_consumable;
                    $up_stock->is_usable = $temp_stock->is_usable;
                    $up_stock->date = $temp_stock->date;
                    $up_stock->stock_owner = $demand_item->demand()->first()->unit_id;
                    $up_stock->created_by = $temp_stock->created_by;
                    $up_stock->publication_status = $temp_stock->publication_status;
                    $up_stock->deletation_status = $temp_stock->deletation_status;
                    $up_stock->save();
                }
            }
        }
        return redirect()->route('list_distribution_main');
    }

    public function distributionSub() {
        $distributions = DistributionSub::where('unit_id', Auth::user()->unit_id())->get();
        $stocks = Stock::where('stock_owner', Auth::user()->unit_id())->where('in_stock', true)->get();
        $employees = Employee::where('unit_id', Auth::user()->unit_id())->get();
        return view('distribution/distribution_sub', compact('stocks', 'employees', 'distributions'));
    }

    public function saveDistributionSub(Request $request) {
        $this->validate($request, [
            'stock_id' => 'required|unique:distribution_subs',
            'employee_id' => 'required',
            'date' => 'required'
        ]);
        if (!Stock::find($request->stock_id)->in_stock) {
            Session::put('alert-danger', 'Product has already distributed');
            return redirect()->back();
        }
        $distribution = new DistributionSub;
        $distribution->fill($request->input());
        $distribution->unit_id = Auth::user()->unit_id();
        $distribution->created_by = Auth::id();
        $distribution->save();
        Stock::where('id', $request->stock_id)->update([
            'in_stock' => false
        ]);
        return redirect()->back();
    }

}
