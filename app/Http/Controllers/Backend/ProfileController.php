<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\VisitorRegistration;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use DB;

class ProfileController extends Controller
{
    public function profile(){
        $user_id=session('id');
        $allUsers=VisitorRegistration::Where('id',$user_id)->first();
        return view('backend.profile.profile',compact('allUsers'));
    }

    public function updateProfile(Request $request){

      $users=VisitorRegistration::find(session('id'));
      $users->name=$request->name;
      $users->email=$request->email;
      $users->phone=$request->phone;

     $photo = $request->file('image');
        if($photo){
            $imgName = time().'_'.$request->file('image')->getClientOriginalExtension();
            $request->file('image')->move('profile/images/',$imgName);
            if(file_exists('profile/images/'.$users->image) AND !empty($users->image)){
                unlink('profile/images/'.$users->image);
            }
            $users->image = $imgName;
        }

        $users->save();
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

        $auth_id = session('id');
        $auth_info = DB::table('visitor_registration')->where('id',$auth_id)->first();

        if($request->password == $request->password_confirmation){
            if (Hash::check($request->old_password, $auth_info->password)) {
                    $users = VisitorRegistration::find($auth_id);
                    $users->password = Hash::make($request->password);
                    $users->save();
                    Session::flash('success','You have successfully changed the password');
                    $request->session()->flush();
                    return redirect('/');

            }else{
                Session::flash('failed','Old password does not matched!');
                return redirect()->back();
            }
        }else{
            Session::flash('failed','New password and confirmed password does not matched!');
            return redirect()->back();
        }

    }
}
