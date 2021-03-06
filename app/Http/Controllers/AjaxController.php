<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateSemesterValidation;
use App\Subject;
use App\Sclass;
use App\Student;
use App\Generation;
use App\RegistrationInformation;
use App\Repositories\StudentRepository;
use App\Repositories\RegistrationRepository;
use App\Repositories\SemesterRepository;
use App\Repositories\GenerationRepository;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    protected $studentRepository;

    public function __construct(
        GenerationRepository $generationRepository,
        StudentRepository $studentRepository,
        RegistrationRepository $registrationRepository,
        SemesterRepository $semesterRepository
    )
    {
        $this->generationRepository = $generationRepository;
        $this->studentRepository = $studentRepository;
        $this->registrationRepository = $registrationRepository;
        $this->semesterRepository = $semesterRepository;
    }

    function getClassTable(Request $rq) {
        $id = $rq['value'];
        $classes = $this->studentRepository->find($id);
        try {
            $stt = 0;
            foreach ($classes as $class) {
                $stt ++;
                $data[] = array(
                    'stt' => $stt,
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
        $generations = $this->generationRepository->getAll();

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
            $generation = $this->generationRepository->find($id);

            echo json_encode($generation);
        }
    }

    function getStudentTable(Request $rq)
    {
        $students = $this->studentRepository->getAllInfo();
        return Datatables::of($students)
        ->addIndexColumn()
        ->editColumn('avatar', function($students){
            if (!empty($students->avatar)) {
                return '<img class="avatar-column-size" src="' . config('social.student-img') . $students->avatar . '" alt="avatar"/>';
            } else {
                return '<img class="avatar-column-size" src="' . config('social.student-default-img') . '" alt="avatar"/>';
            }
        })
        ->addColumn('manager', function($students){
            return '<a href="' . route('student-management.edit', ['id' => $students->id]) . '"><button class="edit-button"><i class="fas fa-edit"></i></button></a>
                <button class="delete-button" data-toggle="modal" data-target="#confirmDelete" data-whatever="' . 
                    $students->id . '"><i class="fas fa-trash-alt"></i></button>';
        })
        ->rawColumns(['avatar','manager'])
        ->toJson();
    }

    function getRegistrationTable()
    {
        $registrations = $this->registrationRepository->getAllInfo();
        
        return registrationDatatable($registrations);
    }

    function createSemester(CreateSemesterValidation $rq)
    {
        $array = array(
            'name' => $rq['name'],
            'begin_date' => $rq['begin_date'],
            'finish_date' => $rq['finish_date']
        );
        $semester = $this->semesterRepository->create($array);
        $semester->success = __('lang.add_success');
        
        echo json_encode($semester);
    }
}
