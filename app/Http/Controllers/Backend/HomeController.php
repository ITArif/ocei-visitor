<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Appointment;
use App\Receptionist;
use App\VisitorRegistration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function dashboard(){
        $visitor_id=session('id');
        $totalAppointment=Appointment::where('visitor_id',$visitor_id)->count();
        $appointmentListData = DB::table('appointment')
            ->leftJoin('employee', 'appointment.employee_id', '=', 'employee.employee_id')
            ->leftJoin('visitor_registration', 'appointment.visitor_id', '=', 'visitor_registration.id')
            ->select('appointment.*', 'employee.first_name as firstName','employee.last_name as lName', 'visitor_registration.name as visitorName')
            ->where('appointment.visitor_id','=',$visitor_id)
            ->orderBy('appointment.id','ASC')
            ->get();
        //dd($appointmentListData);
        return view('backend.dashboard.dashboard')->with(compact('totalAppointment','appointmentListData'));
    }

    public function receptionistDashboard(){
        $totalPendingAppointment=Appointment::where('approval_of',3)->count();
        $totalVisitor=VisitorRegistration::all()->count();
        $ongoingAppointments=Receptionist::where('status',5)->count();
        $totalArchievedAppointment=Receptionist::where('status',1)->count();
        return view('backend.dashboard.receptionist_dashboard')->with(compact('totalPendingAppointment','totalVisitor','ongoingAppointments','totalArchievedAppointment'));
    }

    public function profile(){
        return view('backend.profile.profile');
    }

    public function updateProfile(Request $request){
        $this->validate($request,[
            'user_name'=>'required'
        ]);
          $id=Session::id();
          $visitors=User::find($id);
          $visitors->user_name=$request->user_name;
          $visitors->save();
          //Session::flash('success','Successfully Profile Updated');
          return redirect()->back()->with('success','Successfully Profile Updated!');
    }

     //Update password
    public function updatePassword(Request $request){
        $this->validate($request,[
            'old_password'=>'required',
            'password'=>'required||min:6|confirmed',
            // 'password_confirmation'=>'required|same:new_password',
        ]);
        $hashedPassword=Auth::user()->password;
        //dd($hashedPassword);
        if(Hash::check($request->old_password,$hashedPassword)){
                if(! Hash::check($request['password'],$hashedPassword)){
                $visitors = VisitorAdmin::find(Auth::guard('system_admin')->user()->id);
                $visitors->password = Hash::make($request->password);
                $visitors->save();
                Session::flash('success','You Have Successfully Changed The Password');
                Auth::logout();
                return redirect()->route('visitor.login');
               }else{
                Session::flash('error','New Password Cannot Be The Same As Old Pass');
                return redirect()->back();
               }
        }else{
            Session::flash('error','Old Password Does Not Matched');
            return redirect()->back();
        }
    }

}
