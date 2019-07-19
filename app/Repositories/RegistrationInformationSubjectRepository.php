<?php
namespace App\Repositories;

use App\Repositories\EloquentRepository;
use Illuminate\Support\Facades\DB;
use App\RegistrationInformationSubject;

class RegistrationInformationSubjectRepository extends EloquentRepository
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\RegistrationInformationSubject::class;
    }

    public function storeRegisSubject($registration, $subjects)
    {
        try {
            DB::beginTransaction();
            $oldSubjects = $registration->getSubject()->get();
            foreach ($oldSubjects as $oldSubject) {
                if (array_search($oldSubject->id, $subjects) == false) {
                    RegistrationInformationSubject::where([
                        'registration_information_id' => $registration->id,
                        'subject_id' => $oldSubject->id,
                    ])
                    ->delete();
                }
            }
            foreach ($subjects as $subject) {
                RegistrationInformationSubject::firstOrCreate([
                    'registration_information_id' => $registration->id,
                    'subject_id' => $subject,
                ]);
            }

            DB::commit();
            
            return true;
        } catch(\Exception $e) {
            DB::rollback();

            return false;
        }
    }
}
