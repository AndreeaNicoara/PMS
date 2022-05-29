<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class ProjectRolesModel extends Model
{
    protected $table = 'project_roles';
    protected $allowedFields = ['project_role_id','project_id','member_id','project_role','estimate_hours'];
    public $timestamps = false;

    function get_project_roles_by_project_id($project_id){
        return DB::table('project_roles')->select('*')
        ->where("project_roles.project_id", $project_id)
        ->get();

    }


    function get_all_assign_role_project_by_user_id($user_id){
        
        return DB::table('project_roles')->select('*')
        ->leftJoin('users', 'users.user_id', '=', 'project_roles.member_id')
        ->leftJoin('projects', 'projects.project_id', '=', 'project_roles.project_id')
        ->where("project_roles.member_id",$user_id)
        ->orderBy("projects.project_id", "desc")
        ->groupBy("project_roles.project_id")
        ->get();

    }

    function get_all_assign_roles_by_project_id_and_user_id($project_id,$user_id){
        return DB::table('project_roles')->select('*')
        ->where("project_roles.member_id",$user_id)
        ->where("project_roles.project_id",$project_id)
        ->get();
    }
}
