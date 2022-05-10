<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class ProjectTechnologiesModel extends Model
{
    protected $table = 'project_technologies';
    protected $allowedFields = ['project_technology_id','project_id','technology_name'];
    public $timestamps = false;

    function get_project_technologies_by_project_id($project_id){
        return DB::table('project_technologies')->select('*')
        ->where("project_technologies.project_id", $project_id)
        ->get();

    }
}
