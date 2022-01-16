<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\User;
use Illuminate\Support\Facades\Session;

class EmployeeController extends Controller
{
    public function forwardingVisitor(){
        Session::put('page','forwar-visitor');
        $employee_id = session('user_id');
        //dd($employee_id);
        $forwardingVisitors=DB::table('visitor_registration')
        ->join('department', 'visitor_registration.department_id', '=', 'department.department_id')
        ->join('employee', 'visitor_registration.employee_id', '=', 'employee.employee_id')
        ->join('designation', 'visitor_registration.designation_id', '=', 'designation.designation_id')
        ->select('visitor_registration.*', 'department.department_name as deptName', 'designation.designation_name as desigName','employee.first_name as employee_name')
        ->where('visitor_registration.status', '=', 1)
        ->where('employee.user_id', '=', $employee_id)
        ->get();
        //dd($forwardingVisitors);
        return view('backend.employee.all_forwar_visitor')->with(compact('forwardingVisitors'));
    }
}
