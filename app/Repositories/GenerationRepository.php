<?php
namespace App\Repositories;

use App\Repositories\EloquentRepository;
use Illuminate\Support\Facades\DB;
use App\Student;
use App\Generation;
use App\GenerationRegistrationInformation;

class GenerationRepository extends EloquentRepository
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Generation::class;
    }

    public function safeDelete($id)
    {
        $student = Student::where('generation_id', $id)->first();
        $gri = GenerationRegistrationInformation::where('generation_id', $id)->first();

        $result = false;
        if (empty($student) && empty($gri)) {
            $result = $this->delete($id);
        }

        return $result;
    }

    public function paginate($number)
    {
        $generations = Generation::paginate($number);
        
        return $generations;
    }
}
