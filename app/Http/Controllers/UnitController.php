<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Unit;
use Auth;

class UnitController extends Controller {

    public function listUnit() {
        Session::put('menu', 'unit');
        $units = Unit::get();
        $view = view('unit/list_unit');
        $view->with('units', $units);
        return $view;
    }

    public function addUnit() {
        $view = view('unit/add_unit');
        return $view;
    }

    public function saveUnit(Request $request) {
        $this->validate($request, [
            'unit_name' => 'required',
            // 'area_code' => 'required|unique:units',
            // 'email' => 'required',
        ]);
        $unit = new Unit;
        $unit->fill($request->input());
        $unit->unit_type = 'Sub Unit';
        $unit->created_by = Auth::id();
        $unit->save();
        Session::put('alert-success', 'New item has saved!');
        return redirect()->back();
    }
    public function viewUnit($id) {
        $unit = Unit::find($id);
        $view = view('unit/view_unit');
        $view->with('unit', $unit);
        return $view;
    }
    public function editUnit($id) {
        $unit = Unit::find($id);
        $view = view('unit/edit_unit');
        $view->with('unit', $unit);
        return $view;
    }

    public function updateUnit(Request $request, $id) {
        $this->validate($request, [
            'unit_name' => 'required',
            // 'area_code' => 'required',
            // 'email' => 'required',
        ]);
        $unit = Unit::find($id);
        $unit->fill($request->all());
        $unit->updated_by = Auth::id();
        if ($unit->update()) {
            Session::put('alert-success', 'item has updated!');
            return redirect()->route('list_unit');
        } else {
            Session::put('alert-danger', 'Something went wrong!');
            return redirect()->back();
        }
    }

    public function unpublishUnit($id) {
        $unit = Unit::find($id);
        if($unit->unit_type == 'Main Unit'){
            Session::put('alert-danger', 'You can\'t unpublish Main Unit');
            return redirect()->back();
        }
        $unit->publication_status = false;
        $unit->update();
//        $unit->update(['publication_status' => FALSE]);
        return redirect()->back();
    }

    public function publishUnit($id) {
        $unit = Unit::find($id);
        $unit->publication_status = true;
        $unit->update();
        return redirect()->back();
    }

    public function deleteUnit($id) {
        $unit = Unit::find($id);
        if($unit->unit_type == 'Main Unit'){
            Session::put('alert-danger', 'You can\'t delete Main Unit');
            return redirect()->back();
        }
        $unit->deletation_status = TRUE;
        $unit->update();
        Session::put('alert-success', 'Item has deleted!');
        return redirect()->back();
    }

}
