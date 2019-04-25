<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;

class RouteController extends Controller
{
    public function returnWelcome()
    {
        return view('welcome');
    }

    public function returnStudentLogin()
    {
        return view('student/login');
    }

    public function returnStudentRegister()
    {
        return view('student/register');
    }

    public function returnStudentHome()
    {
        return view('student/home');
    }

    public function studentLogout()
    {
        Auth::logout();

        return view('student/login');
    }

}
