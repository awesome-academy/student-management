<?php

namespace App\Http\Composers;

use App\User;
use App\Student;
use App\Admin;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class UserComposer
{
    public function compose(View $view)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if (!empty($user)) {
                if ($user->role == config('social.role_student')) {
                    $student = $user->getStudent()->firstOrFail();
                    $view->with('student', $student); 
                }
                if ($user->role == config('social.role_admin')) {
                    $admin = $user->getAdmin()->firstOrFail();
                    $view->with('admin', $admin);
                }
                
            } else {
                return redirect(route('students.return_login'));
            }
        }
    }
}
