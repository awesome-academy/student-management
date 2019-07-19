<?php
namespace App\Repositories;

use App\Repositories\EloquentRepository;
use Illuminate\Support\Facades\DB;
use App\Subject;

class SubjectRepository extends EloquentRepository
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Subject::class;
    }

    public function paginate($number)
    {
        $result = Subject::paginate($number);
        
        return $result;
    }
}
