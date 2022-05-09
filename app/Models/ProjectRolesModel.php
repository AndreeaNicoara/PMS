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

    
}
