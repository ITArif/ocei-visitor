<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Employee;
use App\Designation;
use App\Appointment;
use App\Branch;
use DB;

class OfficialController extends Controller
{
    public function officiallist(Request $request){
        //$query = "select * from employee";
        $query = "select branch.*,employee.employee_id as employee_id, employee.first_name as firstName,employee.last_name as lName,employee.phone as ephn,employee.email as eemail,employee.photo as employee_photo from branch Inner join employee on branch.branch_id=employee.branch_id where employee.employee_id in (40,52,66,67,68,69,70,71,72,73,77,79)";
        //dd($query);
        $data['branchs'] =Branch::orderBy('branch_name','DESC')->get();
        //dd($data['branch']);
        if ($request->isMethod('post')) {
          $branch_name = $request->branch_name;

          if($branch_name == '-1'){
          }
          else{
              //$query = $query. " where 1=1 ";

              if($branch_name != '-1'){
                  $query = $query . " AND branch.branch_name = '".$branch_name."'";
              }
          }
           //dd($query);
          $data['employee'] = DB::select($query);

           //dd($data['employee']);

          return view('backend.official.official_list',$data);
      }
      else{

          $data['employee'] = DB::select($query);
          //dd($data['employee']);
          return view('backend.official.official_list',$data);
      }

    }

    public function createAppointment($employee_id){
        $employee=DB::table('employee')
            ->leftJoin('branch', 'employee.branch_id', '=', 'branch.branch_id')
            ->select('employee.*', 'branch.branch_name as branchName')
            ->where('employee.employee_id',$employee_id)
            ->first();
       //$employee=DB::table('employee')->where('employee_id',$employee_id)->first();
       //$branch=Branch::all();
       //dd($employee);
       return view('backend.official.create_appointment',compact('employee'));
    }

    public function storeAppointment(Request $request){
        if ($request->isMethod('post')) {
             $data=$request->all();
            //dd($data);
             $this->validate($request,[
            'date_time'=>'required',
            'purpose'=>'required'
            ]);

             $appointment=new Appointment;
             $appointment->visitor_id=$data['visitor_id'];
             $appointment->employee_id=$data['employee_id'];
             $appointment->branch_id=$data['branch_id'];
             $appointment->date_time=$data['date_time'];
             $appointment->date_time=date("Y-m-d H:i:s",strtotime($data['date_time']));
             $appointment->purpose=$data['purpose'];
             $appointment->status=1;
             $appointment->approval_of=3;
              if(!empty($request->input('request_detail'))) {
                    $appointment->request_detail = $request->request_detail;
                } else {
                    $appointment->request_detail = 'Null';
             }
             $appointment->save();
             return redirect('dashboard')->with('success','Your Appointment Has Been Successfully Created!');
        }
    }
}
