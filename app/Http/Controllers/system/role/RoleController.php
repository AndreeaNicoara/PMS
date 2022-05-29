<?php

namespace App\Http\Controllers\system\role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Validator,Redirect,Response;
use View;
use App\Models\UsersModel;
use App\Models\ProjectsModel;
use App\Models\ProjectUsersModel;
use App\Models\ProjectMembersModel;
use App\Models\ProjectTasksModel;
use App\Models\ApiTemplatesItemsModel;
use App\Models\ProjectRolesModel;
use App\Models\ProjectTechnologiesModel;
use Session;

class RoleController extends Controller
{
    public function index(Request $request){

        $ProjectTasksModel = new ProjectTasksModel();
        $ProjectRolesModel = new ProjectRolesModel();
        $UsersModel = new UsersModel();

        $user_id = Session::get('user')['user_id'];

        $role_projects = $ProjectRolesModel->get_all_assign_role_project_by_user_id($user_id);
        
        $data['page_title'] = 'Roles';
        $data['role_projects'] = $role_projects;
        $data['ProjectTasksModel'] = $ProjectTasksModel;
        $data['UsersModel'] = $UsersModel;

        return view('system/role/role',$data);
        
    }

    public function viewRoleFormAjax(Request $request)
    {
        $UsersModel = new UsersModel();
        $ProjectRolesModel = new ProjectRolesModel();

        $project_id   = $request->get('project_id');
        $user_id   = Session::get('user')['user_id'];

        $role_projects = $ProjectRolesModel->get_all_assign_roles_by_project_id_and_user_id($project_id,$user_id);

        $data['role_projects'] = $role_projects;
         

        return Response::json(array('element' => View::make('system/role/view_role_form_aj',$data)->render()));
    }

}
