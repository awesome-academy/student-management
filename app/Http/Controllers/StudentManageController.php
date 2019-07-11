<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\StudentRepository;
use App\Repositories\GenerationRepository;
use App\Repositories\DepartmentRepository;
use App\Http\Requests\UpdateStudentValidation;
use App\Http\Requests\AddStudentValidation;

class StudentManageController extends Controller
{
   protected $studentRepository, $generationRepository, $departmentRepository;

    public function __construct(
        StudentRepository $studentRepository,
        DepartmentRepository $departmentRepository,
        GenerationRepository $generationRepository

    ){
        $this->studentRepository = $studentRepository;
        $this->generationRepository = $generationRepository;
        $this->departmentRepository = $departmentRepository;
    }

    public function index()
    {
        $generations = $this->generationRepository->getAll();
        $departments = $this->departmentRepository->getAll();

        return view('admin/student-management/student-management', compact('generations', 'departments'));
    }

    public function create()
    {
        $generations = $this->generationRepository->getAll();
        $departments = $this->departmentRepository->getAll();
        
        return view('admin/student-management/add-student',compact('generations', 'departments'));
    }

    public function store(AddStudentValidation $rq)
    {
        $array = array(
            'full_name' => $rq['name'],
            'birth' => $rq['birth'],
            'id_card' => $rq['id_card'],
            'phone' => $rq['phone'],
            'local_address' => $rq['local_address'],
            'current_address' => $rq['current_address'],
            'generation_id' => $rq['generation'],
            'department_id' => $rq['department'],
        );
        $result = $this->studentRepository->create($array);

        if ($result) {
            
            return redirect(route('student-management.index'))->with('success', __('lang.add_success'));
        }

        return redirect()->back()->with('fail', __('lang.add_fail'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $student = $this->studentRepository->find($id);
        $generations = $this->generationRepository->getAll();
        $departments = $this->departmentRepository->getAll();

        if (!empty($student)) {

            return view('admin/student-management/update-student', compact('student', 'generations', 'departments'));
        } else {
            abort(404);
        }
    }

    public function update(UpdateStudentValidation $rq, $id)
    {
        $array = array(
            'full_name' => $rq['name'],
            'birth' => $rq['birth'],
            'id_card' => $rq['id_card'],
            'phone' => $rq['phone'],
            'local_address' => $rq['local_address'],
            'current_address' => $rq['current_address'],
            'generation_id' => $rq['generation'],
            'department_id' => $rq['department'],
        );

        $result = $this->studentRepository->update($id, $array);
        if ($result) {

            return redirect()->back()->with('success', __('lang.update_success'));
        } else {
            return redirect()->back()->with('fail', __('lang.update_fail'));
        }
    }

    public function destroy($id)
    {
        $result = $this->studentRepository->safeDelete($id);
        if ($result) {
            
            return redirect()->back()->with('success', __('lang.delete_success'));
        } else {
            return redirect()->back()->with('fail', __('lang.cannot_delete_now'));
        }
    }
}
