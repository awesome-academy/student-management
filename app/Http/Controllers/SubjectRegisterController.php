<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Sclass;
use App\Student;
use App\SubjectRegistration;

class SubjectRegisterController extends Controller
{
    public function registerSubject(Request $rq)
    {
        $registration = Sclass::findOrFail($rq['radio'])->getRegistrationInformation()->firstOrFail();
        $user = Auth::User();
        $student = Student::findOrFail($user->student_id);
        $subject_registration = SubjectRegistration::where('student_id', $student->id)
        ->where('registration_information_id', $registration->id)->first();
        if (!empty($subject_registration)) {
            return redirect(route('students.return_subject_registration'))->with('subject_registration', $subject_registration);
        } else {
            return redirect(route('students.return_subject_registration'));
        }
    }
}
