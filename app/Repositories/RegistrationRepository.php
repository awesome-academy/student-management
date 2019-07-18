<?php
namespace App\Repositories;

use App\Repositories\EloquentRepository;
use Illuminate\Support\Facades\DB;

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
            ->join('admins', 'registration_information.admin_id', '=', 'admins.id')
            ->select('registration_information.*','admins.full_name AS admin_name')
            ->get();
    }

    public function getInfoDetail($id)
    {
        $registration = $this::find($id)->load(['getSemester', 'getDepartment', 'getAdmin', 'getGeneration']);

        return $registration;
    }
}
