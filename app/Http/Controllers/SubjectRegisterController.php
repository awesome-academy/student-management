<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Sclass;
use App\Student;
use App\SubjectRegistration;
use App\ClassSubjectRegistration;

class SubjectRegisterController extends Controller
{
    public function registerSubject(Request $rq)
    {
        //Kiểm tra đã chọn môn học hay chưa.
        if (isset($rq['radio'])) {
            $class_id = $rq['radio'];
            $registration = Sclass::findOrFail($rq['radio'])->getRegistrationInformation()->firstOrFail();
            $user = Auth::User();
            $student = Student::findOrFail($user->student_id);

            //Kiểm tra xem đã có đăng ký chưa. Nếu chưa có thì tạo, có rồi thì bỏ qua.
            while (empty($subject_registration)) {
                $subject_registration = SubjectRegistration::where('student_id', $student->id)
                ->where('registration_information_id', $registration->id)
                ->first();
                if (empty($subject_registration)) {
                    $subject_registration = new SubjectRegistration;
                    $subject_registration->total_credit = 0;
                    $subject_registration->student_id = $student->id;
                    $subject_registration->registration_information_id = $registration->id;
                    $subject_registration->save();
                }
            }

            //lấy danh sách các lớp học phần đã đăng ký
            $class_subject_registration = ClassSubjectRegistration::where('subject_registration_id', $subject_registration->id)
            ->get();
            // dd($class_subject_registration);
            if (count($class_subject_registration) > 0) {
                $coincide_class_id = 0;

                //Kiểm tra xem lớp học phần đã đăng ký chưa. Nếu chưa tiếp tục kiểm tra xem có bị trùng lịch hay không
                foreach ($class_subject_registration as $csr) {
                    if ($csr->class_id != $class_id) {
                        $oldClass = Sclass::findOrFail($csr->class_id);
                        $newClass = Sclass::findOrFail($class_id);
                        if ($oldClass->subject_id == $newClass->subject_id) {
                            if ($newClass->size <= $newClass->registered ) {
                                return redirect(route('students.return_subject_registration'))
                                ->with('fail', __('lang.class_full'));
                            }

                            $coincide_class_id = $oldClass->id;

                        } else {
                            if ($oldClass->lesson_id == $newClass->lesson_id && $oldClass->day_id == $newClass->day_id)
                            {
                                return redirect(route('students.return_subject_registration'))
                                ->with('fail', __('lang.same_schedule_error'));
                            }
                        }
                    } else {
                        return redirect(route('students.return_subject_registration'))
                        ->with('fail', __('lang.you_registerd_this_class'));
                   }
                }

                //Lưu đăng ký trong trường hợp môn học chưa đăng ký lớp học phần
                if ($coincide_class_id == 0) {
                    $credit = $newClass->getSubject()->firstOrFail()->credits;
                    try {
                        DB::beginTransaction();
                        DB::table('class_subject_registration')->insert([
                            'subject_registration_id' => $subject_registration->id,
                            'class_id' => $class_id,
                        ]);

                        DB::table('subject_registration')
                        ->where('id', $subject_registration->id)
                        ->increment('total_credit', $credit);

                        DB::table('classes')
                        ->where('id', $class_id)
                        ->increment('registered', 1);

                        DB::commit();

                        return redirect(route('students.return_subject_registration'))
                        ->with('success', __('lang.register_success'));
                    } catch(\Exception $e) {
                        DB::rollback();

                        return redirect(route('students.return_subject_registration'))
                        ->with('fail', __('lang.fail_to_register'));
                    }

                // Update lớp học phần mới trong trường hợp môn học đã đăng ký lớp học phần.   
                } else {
                    try {
                        DB::beginTransaction();
                        DB::table('class_subject_registration')
                        ->where('subject_registration_id', $subject_registration->id)
                        ->where('class_id', $coincide_class_id)
                        ->update([
                            'class_id' => $class_id,
                        ]);

                        DB::table('classes')
                        ->where('id', $coincide_class_id)
                        ->decrement('registered', 1);

                        DB::table('classes')
                        ->where('id', $class_id)
                        ->increment('registered', 1);

                        DB::commit();

                        return redirect(route('students.return_subject_registration'))
                        ->with('success', __('lang.register_success'));
                    } catch(\Exception $e) {
                        DB::rollback();

                        return redirect(route('students.return_subject_registration'))
                        ->with('fail', __('lang.fail_to_register'));
                    }
                }

            //Lưu luôn đăng ký trong trường hợp chưa đăng ký lớp học phần cho môn nào
            } else {
                $class = Sclass::findOrFail($class_id);
                $credit = $class->getSubject()->firstOrFail()->credits;
                try {
                        DB::beginTransaction();
                        DB::table('class_subject_registration')
                        ->insert([
                            'subject_registration_id' => $subject_registration->id,
                            'class_id' => $class_id,
                        ]);

                        DB::table('classes')
                        ->where('id', $class_id)
                        ->increment('registered', 1);
                        
                        DB::table('subject_registration')
                        ->where('id', $subject_registration->id)
                        ->increment('total_credit', $credit);

                        DB::commit();

                        return redirect(route('students.return_subject_registration'))
                        ->with('success', __('lang.register_success'));
                    } catch(\Exception $e) {
                        DB::rollback();

                        return redirect(route('students.return_subject_registration'))
                        ->with('fail', __('lang.fail_to_register'));
                    }
            }
        } else {
            return redirect(route('students.return_subject_registration'))
            ->with('fail', __('lang.choose_a_class'));
        }
    }
}
