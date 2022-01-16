<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Employee;
use App\Designation;
use App\Appointment;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    public function appointmentlist(Request $request)
    {
        $from_date = date('Y-m-d 00:00:01', strtotime($request->from_date));
        $to_date = date('Y-m-d 23:59:59', strtotime($request->to_date));
        $visitor_id=session('id');
        //dd($visitor_id);

        $appointmentData = DB::table('appointment')
            ->leftJoin('employee', 'appointment.employee_id', '=', 'employee.employee_id')
            ->leftJoin('visitor_registration', 'appointment.visitor_id', '=', 'visitor_registration.id')
            ->select('appointment.*', 'employee.first_name as firstName','employee.last_name as lName', 'visitor_registration.name as visitorName')
            ->where('appointment.visitor_id','=',$visitor_id)
            ->get();
        //dd($appointmentData);    

        if ($request->isMethod('post')) {
            $status = $request->approval_of;

            if ($status || ($from_date && $to_date)) {
                // dd($status);

                $appointmentData = DB::table('appointment')
                    ->leftJoin('employee', 'appointment.employee_id', '=', 'employee.employee_id')
                    ->leftJoin('visitor_registration', 'appointment.visitor_id', '=', 'visitor_registration.id')
                    ->select('appointment.*', 'employee.employee_id as employee_id', 'employee.first_name as firstName', 'employee.last_name as lName', 'visitor_registration.name as visitorName')
                    ->where('appointment.approval_of', $status)
                    ->where('appointment.visitor_id','=',$visitor_id)
                    ->orWhereBetween('appointment.date_time', [$from_date, $to_date])
                    ->get();

                return view('backend.appointment.appointment_list', compact('appointmentData'));
            }
        }
        return view('backend.appointment.appointment_list', compact('appointmentData'));
    }


}
