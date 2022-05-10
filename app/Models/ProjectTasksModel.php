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

    function get_task_by_project_task_id($project_task_id){
        return DB::table('project_tasks')->select("*")->where('project_task_id', $project_task_id)->first();

    }

    function get_all_tasks_by_user_id($user_id){
        return DB::table('project_tasks')->select('project_tasks.*','projects.project_name')
        ->leftJoin('projects', 'projects.project_id', '=', 'project_tasks.project_id')
        ->where('project_tasks.user_id', $user_id)
        ->orderBy("project_tasks.project_task_id", "desc")
        ->get();

    }

    function get_all_new_tasks_count_by_user_id($user_id){
        return DB::table('project_tasks')->select('project_tasks.*','projects.project_name')
        ->leftJoin('projects', 'projects.project_id', '=', 'project_tasks.project_id')
        ->where('project_tasks.user_id', $user_id)
        ->where('project_tasks.task_status','=','NEW')
        ->orderBy("project_tasks.project_task_id", "desc")
        ->get()->count();

    }

    function get_all_open_tasks_count_by_user_id($user_id){
        return DB::table('project_tasks')->select('project_tasks.*','projects.project_name')
        ->leftJoin('projects', 'projects.project_id', '=', 'project_tasks.project_id')
        ->where('project_tasks.user_id', $user_id)
        ->where('project_tasks.task_status','=','OPENED')
        ->orderBy("project_tasks.project_task_id", "desc")
        ->get()->count();

    }
    function get_all_inprogress_tasks_count_by_user_id($user_id){
        return DB::table('project_tasks')->select('project_tasks.*','projects.project_name')
        ->leftJoin('projects', 'projects.project_id', '=', 'project_tasks.project_id')
        ->where('project_tasks.user_id', $user_id)
        ->where('project_tasks.task_status','=','INPROGRESS')
        ->orderBy("project_tasks.project_task_id", "desc")
        ->get()->count();

    }
    function get_all_completed_tasks_count_by_user_id($user_id){
        return DB::table('project_tasks')->select('project_tasks.*','projects.project_name')
        ->leftJoin('projects', 'projects.project_id', '=', 'project_tasks.project_id')
        ->where('project_tasks.user_id', $user_id)
        ->where('project_tasks.task_status','=','COMPLETED')
        ->orderBy("project_tasks.project_task_id", "desc")
        ->get()->count();

    }


    function get_all_pending_task_by_user_id($user_id){
        return DB::table('project_tasks')->select('project_tasks.*','projects.project_name')
        ->leftJoin('projects', 'projects.project_id', '=', 'project_tasks.project_id')
        ->where('project_tasks.user_id', $user_id)
        ->where('project_tasks.task_status','!=','COMPLETED')
        ->orderBy("project_tasks.project_task_id", "desc")
        ->get();

    }
}
