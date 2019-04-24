<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequestValidation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;

class LoginController extends Controller
{
    public function doStudentLogin(LoginRequestValidation $rq)
    {
        $email = $rq['email'];
        $password = $rq['password'];
        $remember = $rq['remember'];

        if (!empty($remember)) {
            if (Auth::attempt(['email' => $email, 'password' => $password], true)) {
                $token = Auth::User()->remember_token;

                return redirect(route('students.return_home'))->withCookie('remember_token', $token, 14400);
            } else {
                return redirect(route('students.return_login'));
            }
        } else {
            if (Auth::attempt(['email' => $email, 'password' => $password])) {
                return redirect(route('students.return_home'));
            } else {
                return redirect(route('students.return_login'))
                ->with('notification', __('lang.email_password_incorrect'));
            }
        }
    }
}
