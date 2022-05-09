<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class TasksModel extends Model
{
    protected $table = 'tasks';
    protected $allowedFields = ['task_id','project_id','user_id','task_name','start_date','end_date','status'];
    public $timestamps = false;

    function get_all_tasks_by_user_id($user_id){
        return DB::table('tasks')->select('tasks.*','projects.project_name')
        ->leftJoin('projects', 'projects.project_id', '=', 'tasks.project_id')
        ->where('tasks.user_id', $user_id)
        ->orderBy("tasks.task_id", "desc")
        ->get();

    }

    function get_task_by_task_id($task_id){
        return DB::table('tasks')->select("*")->where('task_id', $task_id)->first();

    }

    function get_all_pending_task_by_user_id($user_id){
        return DB::table('tasks')->select('tasks.*','projects.project_name')
        ->leftJoin('projects', 'projects.project_id', '=', 'tasks.project_id')
        ->where('tasks.user_id', $user_id)
        ->where('tasks.status','!=','COMPLETED')
        ->orderBy("tasks.task_id", "desc")
        ->get();

    }

    function get_all_new_tasks_count_by_user_id($user_id){
        return DB::table('tasks')->select('tasks.*','projects.project_name')
        ->leftJoin('projects', 'projects.project_id', '=', 'tasks.project_id')
        ->where('tasks.user_id', $user_id)
        ->where('tasks.status','=','NEW')
        ->orderBy("tasks.task_id", "desc")
        ->get()->count();

    }

    function get_all_open_tasks_count_by_user_id($user_id){
        return DB::table('tasks')->select('tasks.*','projects.project_name')
        ->leftJoin('projects', 'projects.project_id', '=', 'tasks.project_id')
        ->where('tasks.user_id', $user_id)
        ->where('tasks.status','=','OPEN')
        ->orderBy("tasks.task_id", "desc")
        ->get()->count();

    }
    function get_all_inprogress_tasks_count_by_user_id($user_id){
        return DB::table('tasks')->select('tasks.*','projects.project_name')
        ->leftJoin('projects', 'projects.project_id', '=', 'tasks.project_id')
        ->where('tasks.user_id', $user_id)
        ->where('tasks.status','=','INPROGRESS')
        ->orderBy("tasks.task_id", "desc")
        ->get()->count();

    }
    function get_all_completed_tasks_count_by_user_id($user_id){
        return DB::table('tasks')->select('tasks.*','projects.project_name')
        ->leftJoin('projects', 'projects.project_id', '=', 'tasks.project_id')
        ->where('tasks.user_id', $user_id)
        ->where('tasks.status','=','COMPLETED')
        ->orderBy("tasks.task_id", "desc")
        ->get()->count();

    }
}
