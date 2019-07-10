<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use App\Sclass;
use App\Student;
use App\SubjectRegistration;
use App\Generation;

use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    function getClassTable(Request $rq) {
        $id = $rq['value'];
        $classes = Subject::find($id)->getClass()->get();
        try {
            foreach ($classes as $class) {
                $data[] = array(
                    'id_class' => $class->id,
                    'subject' => $class->getSubject()->first()->name,
                    'group' => $class->class_group,
                    'teacher' => $class->teacher,
                    'room' => $class->class_room,
                    'registered' => $class->registered,
                    'size' => $class->size,
                    'lesson' => $class->getLesson()->first()->name,
                    'day' => $class->getDay()->first()->name
                );
            }
            echo json_encode($data);
        } catch (Exception $e) {
            echo null;
        }
        
    }

    function getSchedule(Request $rq)
    {
        $id = $rq['week_id'];
        $user = Auth::User();

        $student = $user->getStudent()->firstOrFail();

        $subject_registration = SubjectRegistration::where('student_id', $student->id)
        ->orderBy('id', 'desc')
        ->first();
        if (!empty($subject_registration)) {
            $classes = $subject_registration->getClass()->get();
            try {
                foreach ($classes as $class) {
                    if ($id > $class->getSubject()->firstOrFail()->lesson) {
                        $data[] = array(
                            'id_class' => $class->id,
                            'teacher' => $class->teacher,
                            'class_group' => $class->class_group,
                            'lessons' => $class->getSubject()->first()->lessons,
                            'credit' => $class->getSubject()->first()->credits,
                            'subject' => $class->getSubject()->first()->name,
                            'room' => $class->class_room,
                            'lesson_id' => $class->getLesson()->first()->id,
                            'day_id' => $class->getDay()->first()->id
                        );
                    }
                }
                echo json_encode($data);
            } catch (Exception $e) {
                echo null;
            }

        } else {
            echo null;
        }
    }
    function getGenerationTable(Request $rq)
    {
        $generations = Generation::select(['id', 'name', 'begin_year']);
        return Datatables::of($generations)
            ->addIndexColumn()
            ->addColumn('manager', function($generations){
                return '<button class="edit-button" data-toggle="modal" data-target="#exampleModal" data-whatever="' . 
                    $generations->id . '"><i class="fas fa-edit"></i></button>
                    <button class="delete-button" onclick="deleteGeneration(' . 
                    $generations->id . ')"><i class="fas fa-trash-alt"></i></button>';

            })
            ->rawColumns(['manager'])
            ->toJson();
    }

    function getGenerationModal(Request $rq)
    {
        if ($rq->has('id')) {
            $id = $rq['id'];
            $generation = Generation::find($id);

            echo json_encode($generation);
        }
    }
}
