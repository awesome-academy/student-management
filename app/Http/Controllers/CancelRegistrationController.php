<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\RegistrationInformation;
use App\Student;
use App\SubjectRegistration;
use App\Sclass;

class CancelRegistrationController extends Controller
{
    public function cancelRegistration(Request $rq)
    {   
        if (!empty($rq['classCheckbox'])) {
            $registration = RegistrationInformation::findOrFail($rq['id']);
            $user = Auth::User();
            $student = Student::findOrFail($user->student_id);
            $subject_registration = SubjectRegistration::where('student_id', $student->id)
                ->where('registration_information_id', $registration->id)
                ->firstOrFail();
            try {
                DB::beginTransaction();
                foreach ($rq['classCheckbox'] as $value) {
                    $credit = Sclass::findOrFail($value)->getSubject()->firstOrFail()->credits;
                    
                    DB::table('class_subject_registration')
                    ->where('subject_registration_id', $subject_registration->id)
                    ->where('class_id', $value)
                    ->delete();

                    DB::table('subject_registration')
                    ->where('id', $subject_registration->id)
                    ->decrement('total_credit', $credit);

                    DB::table('classes')
                    ->where('id', $value)
                    ->decrement('registered', 1);
                }
                DB::commit();

                return redirect(route('students.return_subject_registration'))
                ->with('success', __('lang.cancel_registration_success'));
            } catch (\Exception $e) {
                DB::rollback();

                return redirect(route('students.return_subject_registration'))
                ->with('fail', __('lang.fail_to_cancel_registration'));
            }
        } else {
            return redirect(route('students.return_subject_registration'))
            ->with('fail', __('lang.none_class_selected'));
        }
    }
}
