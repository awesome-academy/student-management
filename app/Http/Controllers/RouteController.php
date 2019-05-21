<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Student;
use App\RegistrationInformation;
use App\Subject;

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

    public function returnStudentInformation()
    {
        return view('student/information/information');
    }

    public function returnStudentUpdateInformation()
    {
        return view('student/information/update_information');
    }

    public function returnSubjectRegistration()
    {   
        $registration = RegistrationInformation::where('status', 1)->first();
        if (!empty($registration)) {
            $now = date('Y-m-d h:i:sa');
            $time_begin = $registration->time_begin;
            $date_begin = $registration->date_begin;
            $time_finish = $registration->time_finish;
            $date_finish = $registration->date_finish;
            $d = strtotime($time_begin . ' ' . $date_begin);
            $begin = date('Y-m-d h:i:sa', $d);
            $dd = strtotime($time_finish . ' ' . $date_finish);
            $finish = date('Y-m-d h:i:sa', $dd);
            if ($begin <= $now && $now <= $finish) {
                if (Auth::check()) {
                    $user = Auth::User();
                    $student = Student::findOrFail($user->student_id);
                    $department = $student->getDepartment()->first();
                    if ($department->id == $registration->department_id) {
                        $generation = $student->getGeneration()->first();
                        $gens = $registration->getGeneration()->get();
                        $boo =  false;
                        foreach ($gens as $gen) {
                            if ($generation->id == $gen->id) {
                                $boo = true;
                            }
                        }
                        if ($boo) {
                            $subjects = $registration->getSubject()->get();
                                
                            return view('student/subject_registration/subject_registration')
                            ->with([
                                'registration' => $registration,
                                'subjects' => $subjects,
                            ]);
                        } else {
                            return view('student/subject_registration/subject_registration')
                            ->with('notification', __('lang.not_allowed_to_register'));
                        }
                    } else {
                        return view('student/subject_registration/subject_registration')
                        ->with('notification', __('lang.not_allowed_to_register'));
                    }
                } else {
                    return redirect(route('students.return_login'));
                }
            } else {
                return view('student/subject_registration/subject_registration')
                ->with('notification', __('lang.not_in_registration_time'));
            }
            
        } else {
            return view('student/subject_registration/subject_registration')
            ->with('notification', __('lang.no_registration_now'));
        }
    }

}
