<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Employee;
use App\Unit;
use Auth;

class EmployeeController extends Controller {

    public function listEmployee() {
        if (Auth::user()->unit_id() == 1) {
            $employees = Employee::orderBy('id', 'desc')
            ->get();
        } else {
            $employees = Employee::where('unit_id', Auth::user()->unit_id())
            ->orderBy('id', 'desc')
            ->get();
        }
        $view = view('employee/list_employee');
        $view->with('heading', 'Employee List');
        $view->with('employees', $employees);
        return $view;
    }

    public function addEmployee() {
        $units = Unit::get();
        $view = view('employee/add_employee');
        $view->with('units', $units);
        return $view;
    }

    public function saveEmployee(Request $request) {
//        dd($request->input());
        $this->validate($request, [
            'employee_name' => 'required',
            'designation' => 'required',
            'phone' => 'required|unique:employees',
        ]);
        $employee = new Employee;
        $employee->fill($request->input());
        $employee->created_by = Auth::id();
        $employee->save();
        Session::put('alert-success', 'New item has saved!');
        return redirect()->back();
    }

    public function viewEmployee($id) {
        $employee = Employee::find($id);
        if ($employee) {
            if ($employee->unit_id != Auth::user()->unit_id() && Auth::user()->unit_id() != 1) {
                abort('404');
            }
            $view = view('employee/view_employee');
            $view->with('employee', $employee);
            return $view;
        } else {
            abort('404');
        }
    }
    public function editEmployee($id) {
        $employee = Employee::find($id);
        if ($employee) {
            if ($employee->unit_id != Auth::user()->unit_id() && Auth::user()->unit_id() != 1) {
                abort('404');
            }
            $units = Unit::get();
            $view = view('employee/edit_employee');
            $view->with('heading', 'Edit Employee');
            $view->with('employee', $employee);
            $view->with('units', $units);
            return $view;
        } else {
            abort('404');
        }
    }

    public function updateEmployee(Request $request, $id) {
        $this->validate($request, [
            'employee_name' => 'required',
            'designation' => 'required',
            'phone' => 'required|unique:employees,phone,' . $id,
        ]);
        $employee = Employee::find($id);
        $employee->fill($request->all());
        $employee->updated_by = Auth::id();
        if ($employee->update()) {
            Session::put('alert-success', 'item has updated!');
            return redirect()->route('list_employee');
        } else {
            Session::put('alert-danger', 'Something went wrong!');
            return redirect()->back();
        }
    }

    public function unpublishEmployee($id) {
        $employee = Employee::find($id);
        $employee->publication_status = false;
        $employee->update();
        return redirect()->back();
    }

    public function publishEmployee($id) {
        $employee = Employee::find($id);
        $employee->publication_status = true;
        $employee->update();
        return redirect()->back();
    }

    public function deleteEmployee($id) {
        $employee = Employee::find($id);
        $employee->deletation_status = TRUE;
        $employee->update();
        Session::put('alert-success', 'Item has deleted!');
        return redirect()->back();
    }

}
