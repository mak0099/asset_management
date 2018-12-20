<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Product;
use App\PreDemand;
use App\Demand;
use App\DemandItem;
use App\DemandApproval;
use App\DemandApprovalItem;
use Auth;
use Session;
use DB;

class DemandController extends Controller {

    public function demandRequestSub() {
        $products = Product::where('publication_status', true)->get();
        $pre_demands = PreDemand::where('unit_id', Auth::user()->unit_id())->get();
        $view = view('demand/demand_request_sub');
        $view->with('products', $products);
        $view->with('pre_demands', $pre_demands);
        return $view;
    }

    public function demandRequestMain() {
        $demands = Demand::orderBy('id', 'desc')->get();
        $demand_items = DemandItem::select('product_id', DB::raw('sum(quantity) as quantity'))
                ->groupBy('product_id')
                ->orderBy('product_id', 'desc')
                ->get();
        $view = view('demand/demand_request_main');
        $view->with('demands', $demands);
        $view->with('demand_items', $demand_items);
        return $view;
    }

    public function savePreDemand(Request $request) {
        $this->validate($request, [
            'product_id' => 'required',
            'quantity' => 'required',
        ]);
        $exist_pre_demand = PreDemand::where('product_id', $request->product_id)->where('unit_id', Auth::user()->unit_id())->first();
        if ($exist_pre_demand) {
            $exist_pre_demand->fill($request->input());
            $exist_pre_demand->updated_by = Auth::id();
            $exist_pre_demand->update();
        } else {
            $preDemand = new PreDemand;
            $preDemand->fill($request->input());
            $preDemand->unit_id = Auth::user()->unit_id();
            $preDemand->created_by = Auth::id();
            $preDemand->save();
        }


        return redirect()->back();
    }

    public function removePreDemandItem($id) {
        PreDemand::where('id', $id)->delete();
        return redirect()->back();
    }
    private function deletePreDemand(){
        PreDemand::where('unit_id', Auth::user()->unit_id())->delete();
    }
    public function removePreDemand() {
        $this->deletePreDemand();
        return redirect()->back();
    }

    public function saveDemand() {
        $unit_id = Auth::user()->unit_id();
        $pre_demands = PreDemand::where('unit_id', $unit_id)->get();
        
        $date = date('Y-m-d', strtotime("+6 hours"));
        $demand_no = $unit_id . time();
        $demand = new Demand;
        $demand->demand_no = $demand_no;
        $demand->unit_id = $unit_id;
        $demand->date = $date;
        $demand->created_by = Auth::id();
        $demand->save();
        foreach ($pre_demands as $item) {
            $demand->demand_items()->insert([
                'demand_id' => $demand->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'logical_brief' => $item->logical_brief,
                'created_by' => Auth::id(),
            ]);
        }
        $this->deletePreDemand();
        return redirect()->route('view_demand', ['demand_no' => $demand_no]);
    }

    public function viewDemand($demand_no) {
        $demand = Demand::where('demand_no', $demand_no)->first();
        $demand_items = DemandItem::where('demand_id', $demand->id)->get();
        $view = view('demand/demand_print');
        $view->with('heading', 'Preview Demand Request');
        $view->with('demand', $demand);
        $view->with('demand_items', $demand_items);
        return $view;
    }

    public function demandApproval($demand_no) {
        $demand = Demand::where('demand_no', $demand_no)->first();
        $demand_items = $demand->demand_items()->get();
        $demand_approval = $demand->demand_approval()->first();
        $view = view('demand/demand_approval');
        $view->with('demand', $demand);
        $view->with('demand_items', $demand_items);
        $view->with('demand_approval', $demand_approval);
        return $view;
    }

    public function saveDemandApproval($demand_id, Request $request) {
        $this->validate($request, [
            'issue_no' => 'required',
            'issue_date' => 'required',
        ]);
        $demand = Demand::find($demand_id);
        $demand_items = $demand->demand_items()->get();
        $demand_approval = new DemandApproval;
        $demand_approval->demand_id = $demand_id;
        $demand_approval->issue_no = $request->issue_no;
        $demand_approval->issue_date = $request->issue_date;
        $demand_approval->created_by = Auth::id();
        if (Input::hasFile('attach_file')) {
            $file = Input::file('attach_file');
            $file_name = 'uploads/' . time() . $file->getClientOriginalName();
            $file->move('uploads', $file_name);
            $demand_approval->file_name = $file_name;
        }
        $demand_approval->save();
        foreach ($demand_items as $demand_item) {
            $approval_item = new DemandApprovalItem;
            $approval_item->demand_approval_id = $demand_approval->id;
            $approval_item->product_id = $demand_item->product_id;
            $approval_item->quantity = $request->input($demand_item->product_id);
            $approval_item->save();
        }
        return redirect()->route('demand_request_main');
    }
}
