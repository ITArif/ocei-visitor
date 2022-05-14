<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Employee;
use App\Designation;
use App\Appointment;
use App\VisitorRegistration;
use App\Receptionist;
use App\Walk_Appointment;
use App\Branch;
use DB;

class ReceptionistController extends Controller
{
    public function checkAppointmentList(Request $request){
        $query = "select appointment.*,visitor_registration.phone as visitorPhone,visitor_registration.name as visitorName,visitor_registration.image as visitor_image,employee.first_name as empeeName,employee.last_name as epeeLastName from appointment left join visitor_registration on appointment.visitor_id=visitor_registration.id left join employee on appointment.employee_id=employee.employee_id where appointment.approval_of = 1 OR appointment.approval_of = 3";

        $data['visitorAppointments']=DB::table('appointment')
            ->leftJoin('visitor_registration', 'appointment.visitor_id', '=', 'visitor_registration.id')
            ->select('appointment.*','visitor_registration.phone as visitorPhone')
            ->get();
        //dd($data['visitorAppointments']);
        
        if ($request->isMethod('post')) {
          $phone = $request->phone;

          if($phone == '-1'){
          }
          else{
              //$query = $query. " where 1=1 ";

              if($phone != '-1'){
                  $query = $query . " AND visitor_registration.phone = '".$phone."'";
              }
          }
           //dd($query);
          $data['checkAppointmentList'] = DB::select($query);

           //dd($data['checkAppointmentList']);

          return view('backend.receptionist.appointment_list',$data);
      }
      else{

          $data['checkAppointmentList'] = DB::select($query);
          //dd($data['checkAppointmentList']);
          return view('backend.receptionist.appointment_list',$data);
      }
    }

    public function receptionistsCreateAppointment($appointment_id){
       //$appointments=DB::table('appointment')->where('id',$appointment_id)->first();
       $appointments=DB::table('appointment')
            ->leftJoin('employee', 'appointment.employee_id', '=', 'employee.employee_id')
            ->leftJoin('visitor_registration', 'appointment.visitor_id', '=', 'visitor_registration.id')
            ->select('appointment.*', 'employee.first_name as firstName', 'employee.last_name as lName', 'visitor_registration.name as visitorName','visitor_registration.phone as visitorPhn')
            ->where('appointment.id','=',$appointment_id)
            ->first();
       //dd($appointments);
       return view('backend.receptionist.create_appointment',compact('appointments'));
    }

    public function storeReceptionistsData(Request $request){
        if ($request->isMethod('post')) {
             $data=$request->all();
             $this->validate($request,[
            'id_card_number'=>'required'
            ]);

             $appointment=new Receptionist;
             $appointment->visitor_id=$data['visitor_id'];
             $appointment->appointment_id=$data['appointment_id'];
             $appointment->employee_id=$data['employee_id'];
             $appointment->branch_id=$data['branch_id'];
             $appointment->date_time=$data['date_time'];
             $appointment->purpose=$data['purpose'];
             $appointment->request_detail=$data['request_detail'];
             $appointment->id_card_number=$data['id_card_number'];
             $appointment->status=5;
             $appointment->save();

             Appointment::where('id',$appointment->appointment_id)->update([
                'approval_of' => 5
            ]);
             //dd($appointment);
             return redirect('receptionists/appointment/list')->with('success','Successfully Saved Data!');
        }
    }

    public function appontmentHistoryData(){
        $appointmentHistory=DB::table('receptionist_appointment')
            ->leftJoin('employee', 'receptionist_appointment.employee_id', '=', 'employee.employee_id')
            ->leftJoin('visitor_registration', 'receptionist_appointment.visitor_id', '=', 'visitor_registration.id')
            ->leftJoin('appointment', 'receptionist_appointment.appointment_id', '=', 'appointment.id')
            ->select('receptionist_appointment.*', 'employee.first_name as firstName', 'employee.last_name as lName', 'visitor_registration.name as visitorName','visitor_registration.phone as visitorPhn','visitor_registration.image as visitor_image')
            ->where('receptionist_appointment.status','=',5)
            ->orderBy('id','DESC')
            ->get();
        //dd($appointmentHistory);
        return view('backend.receptionist.appointment_history')->with(compact('appointmentHistory'));
    }

    public function doneAppointment(Request $request){
        $ids=$request->appointmentData_ids;
        foreach ($ids as $id){
            $appointmentdone = Receptionist::find($id);
            if ($appointmentdone){
                $appointmentdone->status=1;
                $appointmentdone->save();
            }
        }
        return response()->json('success',201);
    }

    public function pendingAppointment(Request $request){
        $ids=$request->appointmentData_ids;
        foreach ($ids as $id){
            $appointmentPending = Receptionist::find($id);
            if ($appointmentPending){
                $appointmentPending->status=0;
                $appointmentPending->save();
            }
        }
        return response()->json('success',201);
    }

    public function archiveAppointmentData(){
        $archiveAppointments=DB::table('receptionist_appointment')
            ->leftJoin('employee', 'receptionist_appointment.employee_id', '=', 'employee.employee_id')
            ->leftJoin('visitor_registration', 'receptionist_appointment.visitor_id', '=', 'visitor_registration.id')
            ->leftJoin('appointment', 'receptionist_appointment.appointment_id', '=', 'appointment.id')
            ->select('receptionist_appointment.*', 'employee.first_name as firstName', 'employee.last_name as lName', 'visitor_registration.name as visitorName','visitor_registration.phone as visitorPhn','visitor_registration.image as visitor_image')
            ->where('receptionist_appointment.status','=',1)
            ->orderBy('id','DESC')
            ->get();
        //dd($archiveAppointments);
        return view('backend.receptionist.archive_appointment')->with(compact('archiveAppointments'));
    }

    // public function doneOngoingAppointment(Request $request, $id){
    //      $ongoingAppointment = Receptionist::where('id',$id)->first();
    //      //dd($ongoingAppointment);
    //      if ($ongoingAppointment){
    //         $ongoingAppointment->status=1;
    //         dd($ongoingAppointment);
    //         $ongoingAppointment->save();
    //         return response()->json('success',201);
    //     }
    //     return response()->json('success',201);
    // }


    public function walkAppointment(Request $request){
        if ($request->isMethod('post')) {
             $data=$request->all();
             $this->validate($request,[
            'name'=>'required',
            'address'=>'required',
            'purpose'=>'required',
            'contact_no'=>'required',
            'employee_id'=>'required',
            'branch_id'=>'required',
            'id_card_number'=>'required',
            'date_time'=>'required'
            ]);

             $walkAppointment=new Walk_Appointment;
             $walkAppointment->name=$data['name'];
             $walkAppointment->address=$data['address'];
             $walkAppointment->purpose=$data['purpose'];
             $walkAppointment->contact_no=$data['contact_no'];
             $walkAppointment->employee_id=$data['employee_id'];
             $walkAppointment->branch_id=$data['branch_id'];
             $walkAppointment->id_card_number=$data['id_card_number'];
             $walkAppointment->date_time=$data['date_time'];
             $walkAppointment->status=5;
             $walkAppointment->save();

             //dd($appointment);
             return redirect()->back()->with('success','Successfully Saved Walk Apponitment Data!');
        }
    }

    public function walkInAppontmentHistoryData(){
        $walkInAppointmentHistory=DB::table('walk_appointment')
            ->leftJoin('employee', 'walk_appointment.employee_id', '=', 'employee.employee_id')
            ->leftJoin('branch', 'walk_appointment.branch_id', '=', 'branch.branch_id')
            ->select('walk_appointment.*', 'employee.first_name as firstName', 'employee.last_name as lName', 'branch.branch_name as branchName')
            ->where('walk_appointment.status','=',5)
            ->orderBy('id','DESC')
            ->get();
        //dd($walkInAppointmentHistory);
        return view('backend.receptionist.walkin_appointment_history')->with(compact('walkInAppointmentHistory'));
    }

    public function doneWalkInAppointment(Request $request){
        $ids=$request->walkinappointmentData_ids;
        foreach ($ids as $id){
            $walkInAppointmentDone = Walk_Appointment::find($id);
            if ($walkInAppointmentDone){
                $walkInAppointmentDone->status=1;
                $walkInAppointmentDone->save();
            }
        }
        return response()->json('success',201);
    }

    public function pendingWalkInAppointment(Request $request){
        $ids=$request->walkinappointmentData_ids;
        foreach ($ids as $id){
            $WalkInAppointmentPending = Walk_Appointment::find($id);
            if ($WalkInAppointmentPending){
                $WalkInAppointmentPending->status=0;
                $WalkInAppointmentPending->save();
            }
        }
        return response()->json('success',201);
    }

    public function archiveWalkInAppointmentData(){
        $archiveWalkInAppointments=DB::table('walk_appointment')
            ->leftJoin('employee', 'walk_appointment.employee_id', '=', 'employee.employee_id')
            ->leftJoin('branch', 'walk_appointment.branch_id', '=', 'branch.branch_id')
            ->select('walk_appointment.*', 'employee.first_name as firstName', 'employee.last_name as lName', 'branch.branch_name as branchName')
            ->where('walk_appointment.status','=',1)
            ->orderBy('id','DESC')
            ->get();
        //dd($archiveWalkInAppointments);
        return view('backend.receptionist.archive_walkin_appointment')->with(compact('archiveWalkInAppointments'));
    }

    public function appointmentReports(Request $request){
      $branchs=Branch::all();
      return view('backend.reports.appointment_reports',compact('branchs'));
    }

    public function employeeWisePrintReport(Request $request){
        if ($request->isMethod('get')) {
            //$from_date = date('Y-m-d 00:00:01', strtotime($request->from_date));
            //$to_date = date('Y-m-d 23:59:59', strtotime($request->to_date));

            $from_dat = $from_date = date('Y-m-d 00:00:01', strtotime($request->from_date));
            $to_dat = $to_date = date('Y-m-d 23:59:59', strtotime($request->to_date));

            $branch = $request->branch_id;
            if ($branch and ($from_date and $to_date)) {
                 //dd($to_date);
                   $appointmentDataBranch=null;
                   $appointmentDataEmployee=null;
                    if ($branch=='branch_wise') {
                        $appointmentDataBranch = DB::select("SELECT `branch`.`branch_name` AS branchName, COUNT(receptionist_appointment.id) as total FROM `receptionist_appointment` 
                        LEFT JOIN `branch` ON `branch`.`branch_id` = `receptionist_appointment`.`branch_id` 
                        WHERE (`receptionist_appointment`.`date_time` BETWEEN '".$from_date."' AND '".$to_date."') AND (`receptionist_appointment`.`status` = 1)
                        GROUP BY receptionist_appointment.branch_id");
                    }else{
                        $appointmentDataEmployee = DB::select("SELECT `employee`.`first_name` AS firstName, `employee`.`last_name` AS lastName, COUNT(receptionist_appointment.id) as total FROM `receptionist_appointment` 
                        LEFT JOIN `employee` ON `employee`.`employee_id` = `receptionist_appointment`.`employee_id` 
                        WHERE (`receptionist_appointment`.`date_time` BETWEEN '".$from_date."' AND '".$to_date."') AND (`receptionist_appointment`.`status` = 1)
                        GROUP BY receptionist_appointment.employee_id");
                    }
                 //dd($appointmentData);
                return view('backend.reports.print_employee_wise_report',['appointmentDataBranch'=> $appointmentDataBranch,'appointmentDataEmployee'=>$appointmentDataEmployee,'from_dat'=>$from_dat,'to_dat'=>$to_dat]);
            }
        }
        //return view('backend.reports.print_employee_wise_report',$appointmentData);
    }


    public function walkInAppointmentReports(Request $request){
      $branchs=Branch::all();
      return view('backend.reports.walkin_appointment_reports',compact('branchs'));
    }


    public function walkAppointmentPrintReport(Request $request){
        if ($request->isMethod('get')) {
            //$from_date = date('Y-m-d 00:00:01', strtotime($request->from_date));
            //$to_date = date('Y-m-d 23:59:59', strtotime($request->to_date));

            $from_dat = $from_date = date('Y-m-d 00:00:01', strtotime($request->from_date));
            $to_dat = $to_date = date('Y-m-d 23:59:59', strtotime($request->to_date));

            $branch = $request->branch_id;
            if ($branch and ($from_date and $to_date)) {
                 //dd($to_date);
                   $appointmentDataBranch=null;
                   $appointmentDataEmployee=null;
                    if ($branch=='branch_wise') {
                        $appointmentDataBranch = DB::select("SELECT `branch`.`branch_name` AS branchName, COUNT(walk_appointment.id) as total FROM `walk_appointment` 
                        LEFT JOIN `branch` ON `branch`.`branch_id` = `walk_appointment`.`branch_id` 
                        WHERE (`walk_appointment`.`date_time` BETWEEN '".$from_date."' AND '".$to_date."') AND (`walk_appointment`.`status` = 1)
                        GROUP BY walk_appointment.branch_id");
                    }else{
                        $appointmentDataEmployee = DB::select("SELECT `employee`.`first_name` AS firstName, `employee`.`last_name` AS lastName, COUNT(walk_appointment.id) as total FROM `walk_appointment` 
                        LEFT JOIN `employee` ON `employee`.`employee_id` = `walk_appointment`.`employee_id` 
                        WHERE (`walk_appointment`.`date_time` BETWEEN '".$from_date."' AND '".$to_date."') AND (`walk_appointment`.`status` = 1)
                        GROUP BY walk_appointment.employee_id");
                    }
                 //dd($appointmentData);
                return view('backend.reports.print_walkappointment_report',['appointmentDataBranch'=> $appointmentDataBranch,'appointmentDataEmployee'=>$appointmentDataEmployee,'from_dat'=>$from_dat,'to_dat'=>$to_dat]);
            }
        }
        //return view('backend.reports.print_walkappointment_report',['appointmentDataBranch'=> $appointmentDataBranch,'appointmentDataEmployee'=>$appointmentDataEmployee,'from_dat'=>$from_dat,'to_dat'=>$to_dat]);
    }

}
