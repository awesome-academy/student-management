<?php
namespace App\Repositories;

use App\Repositories\EloquentRepository;
use Illuminate\Support\Facades\DB;
use App\RegistrationInformation;
use App\GenerationRegistrationInformation;

class RegistrationRepository extends EloquentRepository
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\RegistrationInformation::class;
    }

    public function getAllInfo()
    {
        return DB::table('registration_information')
            ->orderBy('id', 'DESC')
            ->join('admins', 'registration_information.admin_id', '=', 'admins.id')
            ->select('registration_information.*','admins.full_name AS admin_name')
            ->get();
    }

    public function getInfoDetail($id)
    {
        $registration = $this::find($id)->load(['getSemester', 'getDepartment', 'getAdmin', 'getGeneration']);

        return $registration;
    }

    public function checkTime($begin, $finish)
    {
        $registrations = $this->getAll();
        $bo = true;
        foreach ($registrations as $registration) {
            if ($registration->date_begin <= $begin && $registration->date_finish >= $finish) {
                $bo = false;

                return $bo;
            } elseif ($registration->date_begin <= $finish && $registration->date_finish >= $finish) {
                $bo = false;

                return $bo;
            } elseif ($registration->date_begin <= $begin && $registration->date_finish >= $finish) {
                $bo = false;

                return $bo;
            }
        }

        return $bo;
    }

    public function storeRegistration($array, $generations)
    {
        try {
            DB::beginTransaction();
            $id = RegistrationInformation::create($array)->id;
            foreach ($generations as $generation => $value) {
                $gri = new GenerationRegistrationInformation;
                $gri->generation_id =  $value;
                $gri->registration_information_id = $id;
                $gri->save();
            }

            DB::commit();
            
            return $id;
        } catch(\Exception $e) {
            DB::rollback();

            return 0;
        }
    }
}
