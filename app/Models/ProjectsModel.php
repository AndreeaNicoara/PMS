<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class ProjectsModel extends Model
{
    protected $table = 'projects';
    protected $allowedFields = ['project_id','project_name','start_date','end_date','project_manager_id','status'];
    public $timestamps = false;

    function get_all_projects(){
        return DB::table('projects')->select('*')
        ->orderBy("projects.project_id", "desc")
        ->get();

    }

    function get_project_by_project_id($project_id){
        return DB::table('projects')->select("*")->where('project_id', $project_id)->first();

    }

    function get_all_leader_projects($leader_id){
        return DB::table('projects')->select('*')
        ->where("projects.leader_id", $leader_id)
        ->where("projects.status", "0")
        ->orderBy("projects.project_id", "desc")
        ->get();

    }
}
