<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class ProjectTasksModel extends Model
{
    protected $table = 'project_tasks';
    protected $allowedFields = ['project_task_id ','project_id ','project_task'];
    public $timestamps = false;

    function get_tasks_by_project_id($project_id){
        return DB::table('project_tasks')->select('*')
        ->where("project_tasks.project_id", $project_id)
        ->get();

    }
}
