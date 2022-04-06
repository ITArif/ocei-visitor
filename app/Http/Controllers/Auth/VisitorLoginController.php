<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\VisitorRegistration;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class VisitorLoginController extends Controller
{
    private $errors= [];
    protected $redirectTo = '/dashboard';

    public function showLoginForm(){
        return view('backend.auth.login');
    }

    /**
     * Override
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function visitor_login_check(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        $auth = VisitorRegistration::where('email','=', $request->email)->first();
        //dd($auth);
        if ($auth) {
            if (Hash::check($request->password, $auth->password)) {
                session([
                    'id' =>$auth->id,
                    'email' =>$auth->email,
                    'phone' =>$auth->phone,
                    'name' =>$auth->name,
                    'role' =>$auth->role,
                    'image' =>$auth->image,
                ]);
                if ($auth->role == 'visitor') {
                    if ($auth->status == 1) {
                        return redirect('/dashboard');
                    }else{
                        return redirect('/')->with('failed', 'Your are not active.');
                    }

                } elseif ($auth->role == 'receptionist') {
                    if ($auth->status == 1) {
                        return redirect('/receptionists-dashboard');
                    } else {
                        return redirect('/')->with('failed', 'Your are not active.');
                    }
                } else {
                    return redirect('/');
                }
            } else {
                return redirect('/')
                ->withInput($request->only('email'))
                ->with('failed', 'Password do not match.');
            }
        } else {
            return back()->with('failed', 'No account for this email');
        }
    }
    

    protected function guard()
    {
        return Auth::guard('guest');
    }
    /**
     * Override
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/');
    }
}
