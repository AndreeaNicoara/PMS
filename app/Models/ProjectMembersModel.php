<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class ProjectMembersModel extends Model
{
    protected $table = 'project_members';
    protected $allowedFields = ['project_member_id','project_id','member_id'];
    public $timestamps = false;

    function get_project_members_by_project_id($project_id){
        return DB::table('project_members')->select('*')
        ->where("project_members.project_id", $project_id)
        ->get();

    }
}
