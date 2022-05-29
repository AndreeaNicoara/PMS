<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class ProjectUsersModel extends Model
{
    protected $table = 'project_users';
    protected $allowedFields = ['project_users_id','project_id ','user_id'];
    public $timestamps = false;

    
    function get_all_assign_project_users($project_id){
        
        return DB::table('project_users')->select('*')
        ->leftJoin('users', 'users.user_id', '=', 'project_users.user_id')
        ->leftJoin('projects', 'projects.project_id', '=', 'project_users.project_id')
        ->where("project_users.project_id",$project_id)
        ->orderBy("users.user_id", "desc")
        ->get();

    }

    function get_all_assign_project_by_user_id($user_id){
        
        return DB::table('project_users')->select('*')
        ->leftJoin('users', 'users.user_id', '=', 'project_users.user_id')
        ->leftJoin('projects', 'projects.project_id', '=', 'project_users.project_id')
        ->where("project_users.user_id",$user_id)
        ->orderBy("projects.project_id", "desc")
        ->get();

    }
    
}
