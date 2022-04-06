<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class VisitorReceptionistResetPasswordController extends Controller
{
    use ResetsPasswords;

    public function __construct()
    {
        $this->middleware('guest:system_admin');
    }

    protected $redirectTo = '/receptionists-dashboard';

    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwordResetForm')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    protected function guard()
    {
        return Auth::guard('system_admin');
    }

    public function broker()
    {
        return Password::broker('system_admins');
    }
}
