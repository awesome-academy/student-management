<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function returnWelcome()
    {
    	return view('welcome');
    }

    public function returnLogin()
    {
    	return view('student/login');
    }

    public function returnRegister()
    {
    	return view('student/register');
    }
}
