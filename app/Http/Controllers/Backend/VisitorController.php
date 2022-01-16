<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\VisitorRegistration;
use Illuminate\Support\Facades\Session;

class VisitorController extends Controller
{
    public function allVisitor(){
        Session::put('page','visitor-visitors');
        $visitors=DB::table('visitor_registration')
        ->join('department', 'visitor_registration.department_id', '=', 'department.department_id')
        ->join('employee', 'visitor_registration.employee_id', '=', 'employee.employee_id')
        ->join('designation', 'visitor_registration.designation_id', '=', 'designation.designation_id')
        ->select('visitor_registration.*', 'department.department_name as deptName', 'designation.designation_name as desigName','employee.first_name as employee_name')
        ->get();

        $count = VisitorRegistration::where('status','=','1')->count();
        //dd($count);
        //dd($visitors);
        return view('backend.visitor.all_visitor')->with(compact('visitors','count'));
    }

    public function deleteAll(Request $request){
        $ids = $request->visitorId;
        foreach ($ids as $id){
            $visitor = VisitorRegistration::find($id);
            if ($visitor){
                $visitor->delete();
            }
        }
        return response()->json('success',201);
    }

    public function forwordAll(Request $request){
        $ids = $request->visitorId;
        foreach ($ids as $id){
            $visitor = VisitorRegistration::find($id);
            if ($visitor){
                $visitor->status=1;
                $visitor->save();
            }
        }
        return response()->json('success',201);
    }
}
