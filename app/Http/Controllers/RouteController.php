<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Student;
use App\RegistrationInformation;
use App\Subject;
use App\SubjectRegistration;
use App\Semester;
use App\Lesson;
use App\Day;

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
                    $student = $user->getStudent()->firstOrFail();
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
                            $subjectRegistration = SubjectRegistration::
                                where('student_id', $student->id)
                                ->where('registration_information_id', $registration->id)
                                ->first();
                            $registeredClasses = null;
                            if (!empty($subjectRegistration)) {
                                $registeredClasses = $subjectRegistration->getClass()->get();
                            }

                            return view('student/subject_registration/subject_registration', compact('registration', 'subjects', 'subjectRegistration', 'registeredClasses'));
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

    public function returnRegistrationInstruction()
    {
        return view('student/subject_registration/registration_instruction');
    }

    public function returnSchedule(Request $rq)
    {   
        $user = Auth::User();
        $student = $user->getStudent()->firstOrFail();
        $subject_registration = SubjectRegistration::where('student_id', $student->id)
        ->orderBy('id', 'desc')
        ->first();
        if (!empty($subject_registration)) {
            $semester = $subject_registration->getRegistrationInformation()
                ->firstOrFail()
                ->getSemester()
                ->firstOrFail();
            $begin_date = $semester->begin_date;
            if (date('l', strtotime($begin_date)) != 'Monday') {
                $begin_date = date('Y-m-d', strtotime($begin_date . __('lang.next-monday')));
            }
            $count = 1;
            while ($begin_date < $semester->finish_date) {
                $weeks[] = array(
                    'id' => $count,
                    'begin_date' => $begin_date,
                    'finish_date' => date('Y-m-d', strtotime($begin_date . __('lang.next-sunday'))),
                );
                $count ++;
                $begin_date = date('Y-m-d', strtotime($begin_date . __('lang.next-monday')));
            }
            if ($rq['weekSelect']) {
                $lessons = Lesson::all();
                $days = Day::all();
                $now_week = $rq['weekSelect'];

                return view('student/schedule', compact('weeks', 'semester', 'lessons', 'days', 'now_week'));
            }

            $now_date = date ("Y-m-d");
            foreach ($weeks as $week) {
                if ($now_date >= $week['begin_date'] && $now_date <= $week['finish_date']) {
                    $lessons = Lesson::all();
                    $days = Day::all();
                    $now_week = $week['id'];

                    return view('student/schedule', compact('weeks', 'semester', 'lessons', 'days', 'now_week'));
                }
            }
            $lessons = Lesson::all();
            $days = Day::all();

            return view('student/schedule', compact('weeks', 'semester', 'lessons', 'days'));
        } else {
            return view('student/schedule')->with('fail', __('lang.non_schedule'));
        }
        
    }

    public function returnPoint()
    {
        $user = Auth::User();
        $student = $user->getStudent()->firstOrFail();
        $subject_registration = SubjectRegistration::where('student_id', $student->id)
        ->orderBy('id', 'desc')->get();
        if (count($subject_registration) > 0) {
            foreach ($subject_registration as $sr) {
                $semester = $sr->getRegistrationInformation()
                    ->firstOrFail()
                    ->getSemester()
                    ->firstOrFail();
                $classes = $sr->getClass()->get();
                $data[] = array(
                    'semester' => $semester,
                    'classes' => $classes
                );
            }

            return view('student/point')->with('data', $data);
            

        } else {
            return view('student/point')->with('fail', __('lang.non_subject_to_show'));
        }
    }
    
}
