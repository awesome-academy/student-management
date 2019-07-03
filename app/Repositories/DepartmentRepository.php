<?php
namespace App\Repositories;

use App\Repositories\EloquentRepository;

class DepartmentRepository extends EloquentRepository
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Department::class;
    }
}
