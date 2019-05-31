<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StudentInformationUpdateRequest;
use Illuminate\Http\Request;
use App\Repositories\StudentRepository;

class HomeController extends Controller
{
    protected $studentRepository;

    function __construct(StudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    public function updateStudentInformation(StudentInformationUpdateRequest $rq)
    {
        $avatar = '';
        if ($rq->hasFile('avatar')) {
            $file = $rq->file('avatar');
            $name = $file->getClientOriginalName();
            $avatar = str_random(3) . $name;
            while (file_exists(config('social.student-img') . $avatar)) {
                $avatar = str_random(3) . $name;
            }
            $file->move('student_img', $avatar);
            
        }
        if (Auth::check()) {
            $array = array(
                'avatar' => $avatar,
                'birth' => $rq['birth'],
                'phone' => $rq['phone'],
                'current_address' => $rq['current_address'],
            );
            $student = Auth::user()->getStudent()->firstOrFail();
            $result = $this->studentRepository->update($student->id, $array);
            if ($result) {
                return redirect(route('students.return_update_information'))
                ->with('success', __('lang.update_success'));
            } else {
                return redirect(route('students.return_update_information'))
                ->with('notification', __('lang.update_fail'));
            }
        } else {
            return redirect(route('students.return_login'));
        }
    }
}
