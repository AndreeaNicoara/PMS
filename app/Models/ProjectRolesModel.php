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
}
