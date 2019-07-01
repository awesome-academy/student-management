<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequestValidation;
use Illuminate\Support\Facades\Auth;
use App\User;

class AdminLoginController extends Controller
{
    public function doAdminLogin(LoginRequestValidation $rq)
    {
        $email = $rq['email'];
        $password = $rq['password'];
        $remember = $rq['remember'];

        if (!empty($remember)) {
            if (Auth::attempt(['email' => $email, 'password' => $password, 'role' => config('social.role_admin')], true)) {
                $token = Auth::User()->remember_token;

                return redirect(route('admins.return_home'))->withCookie('remember_token', $token, 14400);
            } else {
                return redirect(route('admins.return_login'));
            }
        } else {
            if (Auth::attempt(['email' => $email, 'password' => $password, 'role' => config('social.role_admin')])) {
                return redirect(route('admins.return_home'));
            } else {
                return redirect(route('admins.return_login'))
                ->with('notification', __('lang.email_password_incorrect'));
            }
        }
    }
}
