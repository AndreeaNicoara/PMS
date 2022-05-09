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
}
