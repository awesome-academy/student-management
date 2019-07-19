<?php
namespace App\Repositories;

use App\Repositories\EloquentRepository;
use App\Semester;

class SemesterRepository extends EloquentRepository
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Semester::class;
    }
}
