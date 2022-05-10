<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class ApiTemplatesItemsModel extends Model
{
    protected $table = 'api_template_items';
    protected $allowedFields = ['api_template_item_id','project_id','template_item'];
    public $timestamps = false;

    function get_api_template_items_by_project_id($project_id){
        return DB::table('api_template_items')->select('*')
        ->where("api_template_items.project_id", $project_id)
        ->get();

    }
}
