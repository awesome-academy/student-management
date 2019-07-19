<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateRegistrationValidation;
use App\Repositories\RegistrationRepository;
use App\GenerationRegistrationInformation;
use App\RegistrationInformation;
use App\Repositories\SemesterRepository;
use App\Repositories\DepartmentRepository;
use App\Repositories\GenerationRepository;
use App\Http\Requests\ChooseSubjectValidation;
use App\Repositories\RegistrationInformationSubjectRepository;

class RegistrationManagementController extends Controller
{
    protected $registrationRepository,
        $departmentRepository,
        $semesterRepository,
        $registrationInformationSubjectRepository;

    public function __construct(
        RegistrationRepository $registrationRepository,
        SemesterRepository $semesterRepository,
        DepartmentRepository $departmentRepository,
        GenerationRepository $generationRepository,
        RegistrationInformationSubjectRepository $registrationInformationSubjectRepository
    ){
        $this->registrationRepository = $registrationRepository;
        $this->semesterRepository = $semesterRepository;
        $this->departmentRepository = $departmentRepository;
        $this->generationRepository = $generationRepository;
        $this->registrationInformationSubjectRepository = $registrationInformationSubjectRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/registration-management/registration-management');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $generations = $this->generationRepository->paginate(4);
        $departments = $this->departmentRepository->getAll();
        $semesters = $this->semesterRepository->getAll();

        return view('admin/registration-management/create-registration', compact('departments', 'semesters', 'generations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRegistrationValidation $rq)
    {
        if ($rq['date_begin'] == $rq['date_finish'] && $rq['time_begin'] > $rq['time_finish']) {

            return redirect()->back()->with('fail', __('lang.time_finish_after_or_equal_time_begin'));
        } else {
            $result = $this->registrationRepository->checkTime($rq['date_begin'], $rq['date_finish']);
            if ($result) {
                $array = array(
                    'name' => $rq['name'],
                    'time_begin' => $rq['time_begin'],
                    'date_begin' => $rq['date_begin'],
                    'time_finish' => $rq['time_finish'],
                    'date_finish' => $rq['date_finish'],
                    'min_credits' => $rq['min_credit'],
                    'max_credits' => $rq['max_credit'],
                    'admin_id' => $rq['admin_id'],
                    'department_id' => $rq['department'],
                    'semester_id' => $rq['semester']
                );
                $generations = $rq['generations'];

                $id = $this->registrationRepository->storeRegistration($array, $generations);
                if ($id != 0) {

                    return redirect()->back()->with('success', __('lang.create_success'));
                } else {
                    return redirect()->back()->with('fail', __('lang.save_fail'));
                }
            } else {
                return redirect()->back()->with('fail', __('lang.coincide_time'));
            }

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $registration = $this->registrationRepository->getInfoDetail($id);

        return view('admin/registration-management/show-registration', compact('registration'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function storeSubject(ChooseSubjectValidation $rq)
    {
        $registration = $this->registrationRepository->find($rq['id']);
        $subjects = $rq['subjects'];

        $result = $this->registrationInformationSubjectRepository->storeRegisSubject($registration, $subjects);
        if ($result) {
            
            return redirect()->back()->with('success', __('lang.update_success'));
        } else {
            return redirect()->back()->with('fail', __('lang.save_fail'));
        }
    }
}
