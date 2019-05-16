<?php
namespace App\Repositories;

use App\Repositories\EloquentRepository;

class ClassSubjectRegistrationRepository extends EloquentRepository
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\ClassSubjectRegistration::class;
    }
}
