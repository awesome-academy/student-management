<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Generation;
use App\Repositories\GenerationRepository;
use App\Http\Requests\AddGenerationValidation;
use App\Http\Requests\UpdateGenerationValidation;


class GenerationManagementController extends Controller
{
    protected $generationRepository;

    public function __construct(GenerationRepository $generationRepository)
    {
        $this->generationRepository = $generationRepository;
    }

    function addGeneration(AddGenerationValidation $rq)
    {
        $array = array(
            'name' => $rq['name'],
            'begin_year' => $rq['begin_year'],
        );
        
        $result = $this->generationRepository->create($array);

        if($result) {
            return redirect(route('admins.return_generation_management'))->with('success', __('lang.add_success'));
        } else {
            return redirect(route('admins.return_generation_management'))->with('fail', __('lang.add_fail'));
        }

    }

    function updateGeneration(UpdateGenerationValidation $rq)
    {
        $id = $rq['id'];
        $array = array(
            'name' => $rq['name'],
            'begin_year' => $rq['begin_year'],
        );
        $result = $this->generationRepository->update($id, $array);

        if($result) {
            return redirect(route('admins.return_generation_management'))
                ->with('success', __('lang.update_success'));
        } else {
            return redirect(route('admins.return_generation_management'))->with('fail', __('lang.update_fail'));
        }

    }

    function deleteGeneration(Request $rq)
    {
        $id = $rq['id'];

        $result = $this->generationRepository->safeDelete($id);
        if ($result) {
            return redirect(route('admins.return_generation_management'))
                ->with('success', __('lang.delete_success'));
        } else {
            return redirect(route('admins.return_generation_management'))->with('fail', __('lang.cannot_delete_now'));
        }
    }
}
