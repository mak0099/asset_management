<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Demand;
use App\DemandItem;
use App\Stock;
use App\DistributionSub;
use DB;
use Auth;

class ReportController extends Controller
{
    public function onDemandReport(){
        $demands = Demand::all();
        $demand_items = DemandItem::select('product_id', DB::raw('sum(quantity) as quantity'))
                ->groupBy('product_id')
                ->get();
        $view = view('report/demand_report');
        $view->with('demands', $demands);
        $view->with('demand_items', $demand_items);
        return $view;
    }
    public function onStockReport(){
        $stocks = Stock::select('product_id', DB::raw('sum(quantity) as quantity'))
                ->groupBy('product_id')
                ->where('stock_owner', Auth::user()->unit_id())
                ->get();
        $view = view('report/stock_report');
        $view->with('stocks', $stocks);
        return $view;
    }
    public function onDistributionReport(){
        $distributions = DistributionSub::all();
        return view('report/distribution_report', compact('distributions'));
    }
}
