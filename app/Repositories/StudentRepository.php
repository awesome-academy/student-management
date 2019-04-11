<?php
namespace App\Repositories;

use App\Repositories\EloquentRepository;

class StudentRepository extends EloquentRepository
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Student::class;
    }
}
