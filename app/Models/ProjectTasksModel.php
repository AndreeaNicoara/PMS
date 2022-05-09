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
}
