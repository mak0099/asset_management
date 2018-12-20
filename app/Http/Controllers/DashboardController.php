<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class DashboardController extends Controller
{
    public function getDashboard(){
    	$view = view('dashboard');
    	$view->with('total_employee', \App\Employee::where('unit_id', Auth::user()->unit_id())->count());
    	$view->with('total_demand', \App\Demand::count());
    	$view->with('total_unit', \App\Unit::count());
    	$view->with('total_demand_approval', \App\DemandApproval::count());
    	$view->with('total_demand_distribution', \App\DistributionMain::count());
        return $view;
    }
}
