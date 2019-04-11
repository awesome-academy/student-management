<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use App\Sclass;

class AjaxController extends Controller
{
    function getClassTable(Request $rq) {
        $id = $rq['value'];
        $classes = Subject::find($id)->getClass()->get();
        foreach ($classes as $class) {
        	$data[] = array(
        		'id_class' => $class->id,
        		'subject' => $class->getSubject()->firstOrFail()->name,
        		'group' => $class->class_group,
        		'teacher' => $class->teacher,
        		'room' => $class->class_room,
        		'registered' => $class->registered,
        		'size' => $class->size,
        		'lesson' => $class->getLesson()->firstOrFail()->name,
        		'day' => $class->getDay()->firstOrFail()->name
        	);
        }
       echo json_encode($data);
    }
}
