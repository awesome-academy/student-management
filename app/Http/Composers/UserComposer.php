<?php

namespace App\Http\Composers;

use App\User;
use App\Student;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class UserComposer
{
    public function compose(View $view)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if (!empty($user)) {
                $student = $user->getStudent()->firstOrFail();
                $view->with('student', $student);
            } else {
                return redirect(route('students.return_login'));
            }
        }
    }
}
