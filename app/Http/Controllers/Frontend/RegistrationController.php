<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\VisitorRegistration;
use App\Employee;
use DB;

class RegistrationController extends Controller
{
    public function register(){
        // $departments=DB::table('department')->get();
        // $designations=DB::table('designation')->get();
        // $employees=DB::table('employee')->get();
        //dd($departments);
        return view('frontend.auth.register');
    }

    public function storeRegister(Request $request){
        if ($request->isMethod('post')) {
             $data=$request->all();
            //dd($data);
             $this->validate($request,[
            'name'=>'required',
            'phone' => 'required|regex:/(01)[0-9]{9}/|size:11',
            'email' => 'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'password'=>'required|min:6',
            'password_confirmation'=>'required|same:password'
            ]);

             ////Chek if visitor exist
             $visitorCount=VisitorRegistration::where('email',$data['email'])->count();
             if ($visitorCount > 0) {
                  return redirect()->back()->with('danger', 'Opps! You are already registered');   
             }else{
                 $visitor_register=new VisitorRegistration;
                 $visitor_register->name=$data['name'];
                 $visitor_register->phone=$data['phone'];
                 $visitor_register->email=$data['email'];
                 $visitor_register->password=Hash::make($data['password']);
                 $visitor_register->role='visitor';
                 $visitor_register->status=0;
                  if(!empty($request->input('address'))) {
                        $visitor_register->address = $request->address;
                    } else {
                        $visitor_register->address = 'Null';
                 }

                 // file upload
                    if ($request->hasFile('image')){
                        $photo = $request->file('image');
                        $filename = time().".".$photo->getClientOriginalExtension();
                        $destination_path = public_path('profile/images');
                        $photo->move($destination_path,$filename);
                        $visitor_register->image = $filename;
                    }
                  //dd($visitor_register);
                 $visitor_register->save();

                 ///Send email verification & confirmation account
                 $email=$data['email'];
                 $messageData=[
                    'email' =>$data['email'],
                    'name' =>$data['name'],
                    'code' =>base64_encode($data['email'])
                 ];
                 Mail::send('frontend.emails.confirmationEmail',$messageData, function($message) use($email){
                    $message->to($email)->subject('Please confirm your account');
                 });
                 return redirect('/')->with('success','Please confirm your email to activate your account!');
             }   
        }
    }

    public function confirmAccount($email){
        $email=base64_decode($email);
        $visitorCount=VisitorRegistration::where('email',$email)->count();
        if ($visitorCount > 0) {
            $visitorDetails=VisitorRegistration::where('email',$email)->first();
            if ($visitorDetails->status ==1) {
                return redirect('/')->with('success','Your account is alrady activated.Please login!');
            }else{
                VisitorRegistration::where('email',$email)->update(['status'=>1]);
                //Send register email message
                 $messageData=['name'=>$visitorDetails['name'],'phone'=>$visitorDetails['phone'],'email'=>$email];
                 Mail::send('frontend.emails.registerMail',$messageData, function($message) use($email){
                    $message->to($email)->subject('প্রধান বিদ্যুৎ পরিদর্শকের দপ্তর থেকে আপনাকে অভিনন্দন');
                 });
                 return redirect('/')->with('success','Your account is activated.Please login now!');
            }
        }else{
            abort(404);
        }
    }
}
