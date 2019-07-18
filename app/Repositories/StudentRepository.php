<?php
namespace App\Repositories;

use App\Repositories\EloquentRepository;
use Illuminate\Support\Facades\DB;
use App\Student;

class StudentRepository extends EloquentRepository
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Student::class;
    }

    public function getAllInfo()
    {
        return DB::table('students')
            ->orderBy('id', 'DESC')
            ->join('generations', 'students.generation_id', '=', 'generations.id')
            ->join('departments', 'students.department_id', '=', 'departments.id')
            ->select('students.*','generations.name AS generation_name', 'departments.name AS department_name')
            ->get();
    }

    public function safeDelete($id)
    {
        $student = Student::findOrFail($id);

        if ($student->user_id == null) {
            $subject_registration = $student->getSubjectRegistration()->first();

            if (empty($subject_registration)) {
                try {
                    $student->delete();

                    return true;
                } catch (Exception $e) {
                    return false;
                }
            } else {
                return false;
            }
            
        } else {
            return false;
        }

    }
}
