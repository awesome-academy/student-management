<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignupRequestValidation;
use Illuminate\Http\Request;
use App\Repositories\StudentRepository;
use App\Repositories\UserRepository;
use App\User;
use App\Student;



class RegisterController extends Controller
{
    protected $userRepository;


    function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function doStudentRegister(SignupRequestValidation $rq)
    {
        $email = $rq['email'];
        $idCard = $rq['student_id'];
        $password = $rq['password'];
        $rePassword = $rq['rePassword'];

        if ($password == $rePassword) {
            $student = Student::where('id_card', $idCard)->first();
            if (empty($student)) {
                return redirect('students/register')->with('notification', __('lang.non_exist_id'));
            } else {
                $user = $student->getUser()->first();
                if (empty($user)) {
                    $count = User::where('email', $email)->count();
                    if ($count != 0) {
                        return redirect('students/register')->with('notification', __('lang.email_exist'));
                    }
                    $data = array(
                        'email' => $email,
                        'password' => bcrypt($password),
                        'role' => 1,
                        'student_id' => $student['id'],
                    );
                    $result = $this->userRepository->create($data);
                    
                    if ($result) { 
                        return redirect(route('students.return_register'))
                        ->with('success', __('lang.register_success'));
                    } else {
                        return redirect(route('students.return_register'))->with('notification', __('lang.save_fail'));
                    }
                } else {
                    return redirect(route('students.return_register'))
                    ->with('notification', __('lang.student_had_account'));
                }
            }
        } else {
            return redirect(route('students.return_register'))
            ->with('notification', __('lang.confirm_password_incorrect'));
        }
    }
}
