<?php

namespace App\Http\Controllers\system\project;

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


class ProjectController extends Controller
{
    
    public function index(Request $request){

        $ProjectsModel = new ProjectsModel();
        $UsersModel = new UsersModel();
        $ProjectTasksModel = new ProjectTasksModel();
        $user_id = Session::get('user')['user_id'];

        $user_projects = $ProjectsModel->get_all_user_projects($user_id);
        
        $data['page_title'] = 'Projects';
        $data['user_projects'] = $user_projects;
        $data['UsersModel'] = $UsersModel;
        $data['ProjectTasksModel'] = $ProjectTasksModel;

        return view('system/project/project',$data);
        
    }

    
    public function addProjectFormAjax(Request $request)
    {
        $UsersModel = new UsersModel();

        $project_managers = $UsersModel->get_all_active_users();

        $data['project_managers'] = $project_managers;
        $data['user_id'] = Session::get('user')['user_id'];

        return Response::json(array('element' => View::make('system/project/add_project_form_aj',$data)->render()));
    }

    
    public function addProjectProcess(Request $request)
    {
        $ProjectsModel = new ProjectsModel();
        
        $session = session();

        
        $project_type   = $request->get('project_type');
        $project_name   = $request->get('project_name');
        $project_code   = $request->get('project_code');
        $project_description = $request->get('project_description');
        $start_date = $request->get('start_date');
        $end_date   = $request->get('end_date');
        $total_hours    = $request->get('total_hours');
        $stakeholders  = $request->get('stakeholders');
        $project_status = $request->get('project_status');
        $github_repository=$request->get('github_repository');

        
        $project_members= $request->get('project_members');
        $project_tasks= $request->get('project_tasks');
        $project_task_users= $request->get('project_task_users');
        $api_templates=$request->get('api_templates');

        $selected_member_ids = $request->get('selected_member_ids');
        $selected_roles = $request->get('selected_roles');
        $selected_estimate_hours = $request->get('selected_estimate_hours');

        $project_technologies=$request->get('project_technologies');
       
        $status= "0";

        
        $ProjectsModel->project_code = $project_code;
        $ProjectsModel->project_name = $project_name;
        $ProjectsModel->project_description = $project_description;
        $ProjectsModel->start_date = $start_date;
        $ProjectsModel->end_date = $end_date;
        $ProjectsModel->total_hours = $total_hours;
        $ProjectsModel->stakeholder = $stakeholders;
        $ProjectsModel->git_repository= $github_repository; 
        $ProjectsModel->project_type = $project_type;
        $ProjectsModel->project_status = $project_status;
        $ProjectsModel->status = $status; 
        $ProjectsModel->user_id = Session::get('user')['user_id'];
        $ProjectsModel->added_by = Session::get('user')['user_id'];
        $ProjectsModel->added_date = date("Y-m-d H:i:s");

        $project_added=$ProjectsModel->save();
        $project_id = $ProjectsModel->id;

       
        foreach($project_members as $pm_key => $project_member){
            if($project_member!=""){
                $ProjectMembersModel = new ProjectMembersModel();
                $ProjectMembersModel->project_id = $project_id;
                $ProjectMembersModel->member_id = $project_member;
                $project_members_added=$ProjectMembersModel->save();
                
            }
            
        }
        
        foreach($project_tasks as $pt_key => $project_task){
            if($project_task!=""){
                $ProjectTasksModel = new ProjectTasksModel();
                $ProjectTasksModel->project_id = $project_id;
                $ProjectTasksModel->project_task = $project_task;
                $ProjectTasksModel->user_id = $project_task_users[$pt_key];
                $ProjectTasksModel->added_by = Session::get('user')['user_id'];
                $ProjectTasksModel->added_date = date("Y-m-d H:i:s");
                $project_tasks_added=$ProjectTasksModel->save();
                
            }
            
        }
        
        foreach($api_templates as $ati_key => $api_template){
            if($api_template!=""){
                $ApiTemplatesItemsModel = new ApiTemplatesItemsModel();
                $ApiTemplatesItemsModel->project_id = $project_id;
                $ApiTemplatesItemsModel->template_item = $api_template;
                $ApiTemplatesItemsModel->added_by = Session::get('user')['user_id'];
                $ApiTemplatesItemsModel->added_date = date("Y-m-d H:i:s");
                $api_template_items_added=$ApiTemplatesItemsModel->save();
                
            }
            
        }

        
        foreach($selected_member_ids as $pr_key => $selected_member_id){
            if($selected_member_id!=""){
                $ProjectRolesModel = new ProjectRolesModel();
                $ProjectRolesModel->project_id = $project_id;
                $ProjectRolesModel->member_id = $selected_member_id;
                $ProjectRolesModel->project_role = $selected_roles[$pr_key];
                $ProjectRolesModel->estimate_hours = $selected_estimate_hours[$pr_key];
                $project_roles_added=$ProjectRolesModel->save();
                
            }
            
        }


        
        foreach($project_technologies as $pr_key => $project_technology){
            if($project_technology!=""){
                $ProjectTechnologiesModel = new ProjectTechnologiesModel();
                $ProjectTechnologiesModel->project_id = $project_id;
                $ProjectTechnologiesModel->technology_name = $project_technology;
                $ProjectTechnologiesModel->added_by = Session::get('user')['user_id'];
                $ProjectTechnologiesModel->added_date = date("Y-m-d H:i:s");
                $project_technology_added=$ProjectTechnologiesModel->save();
                
            }
            
        }

        $response = array(
            'status' => true,
            'message' => "Project added successfully."
        );

        echo json_encode($response);
    }

    
    public function editProjectFormAjax(Request $request)
    {
        $project_id = $request->get('project_id');

        $UsersModel = new UsersModel;
        $ProjectsModel = new ProjectsModel();
        $ProjectMembersModel = new ProjectMembersModel();
        $ProjectTasksModel = new ProjectTasksModel();
        $ApiTemplatesItemsModel = new ApiTemplatesItemsModel();
        $ProjectTechnologiesModel = new ProjectTechnologiesModel();

        $project = $ProjectsModel->get_project_by_project_id($project_id);
        $project_members = $ProjectMembersModel->get_project_members_by_project_id($project_id);
        $project_tasks = $ProjectTasksModel->get_tasks_by_project_id($project_id);
        $api_template_items = $ApiTemplatesItemsModel->get_api_template_items_by_project_id($project_id);
        $project_technologies = $ProjectTechnologiesModel->get_project_technologies_by_project_id($project_id);

        $api_template_items_array=[];
        foreach($api_template_items as $api_template_item){
            $api_template_items_array[]=$api_template_item->template_item;
        }

        $project_managers = $UsersModel->get_all_active_users();

        $data['project_managers'] = $project_managers;
        $data['project'] = $project;
        $data['project_members'] = $project_members;
        $data['project_tasks'] = $project_tasks;
        $data['api_template_items_array'] = $api_template_items_array;
        $data['project_technologies'] = $project_technologies;
        $data['user_id'] = Session::get('user')['user_id'];

        return Response::json(array('element' => View::make('system/project/edit_project_form_aj',$data)->render()));
    }

    
    public function updateProjectProcess(Request $request)
    {
        $ProjectsModel = new ProjectsModel();
        $session = session();

        
        $project_id   = $request->get('project_id');
        $project_type   = $request->get('project_type');
        $project_name   = $request->get('project_name');
        $project_code   = $request->get('project_code');
        $project_description = $request->get('project_description');
        $start_date = $request->get('start_date');
        $end_date   = $request->get('end_date');
        $total_hours    = $request->get('total_hours');
        $stakeholders  = $request->get('stakeholders');
        $project_status = $request->get('project_status');
        $github_repository=$request->get('github_repository');

        
        $project_members= $request->get('project_members');
        $project_tasks= $request->get('project_tasks');
        $project_task_users= $request->get('project_task_users');
        $api_templates=$request->get('api_templates');

        $selected_member_ids = $request->get('selected_member_ids');
        $selected_roles = $request->get('selected_roles');
        $selected_estimate_hours = $request->get('selected_estimate_hours');

        $project_technologies=$request->get('project_technologies');
       
        $status= "0";

        $project_updated = $ProjectsModel::where('project_id', $project_id)->update(
            array(
                'project_code'   => $project_code,
                'project_name'   => $project_name,
                'project_description'   => $project_description,
                'start_date'   => $start_date,
                'end_date'   => $end_date,
                'total_hours'   => $total_hours,
                'stakeholder'   => $stakeholders,
                'git_repository'   => $github_repository,
                'project_type'   => $project_type,
                'project_status'   => $project_status,
                'status'   => $status,
                'user_id'   => Session::get('user')['user_id'],
                'updated_by'   => Session::get('user')['user_id'],
                'updated_date'   => date("Y-m-d H:i:s"),
            )
        );
        

        $ProjectMembersModel = new ProjectMembersModel();
        $project_member_deleted = $ProjectMembersModel::where('project_id', $project_id)->delete();

        $ProjectTasksModel = new ProjectTasksModel();
        $project_task_deleted = $ProjectTasksModel::where('project_id', $project_id)->delete();

        $ApiTemplatesItemsModel = new ApiTemplatesItemsModel();
        $project_api_templates_deleted = $ApiTemplatesItemsModel::where('project_id', $project_id)->delete();

        $ProjectRolesModel = new ProjectRolesModel();
        $project_role_deleted = $ProjectRolesModel::where('project_id', $project_id)->delete();

        $ProjectTechnologiesModel = new ProjectTechnologiesModel();
        $project_technology_deleted = $ProjectTechnologiesModel::where('project_id', $project_id)->delete();

       
        if(isset($project_members)){
            foreach($project_members as $pm_key => $project_member){
                if($project_member!=""){
                    $ProjectMembersModel = new ProjectMembersModel();
                    $ProjectMembersModel->project_id = $project_id;
                    $ProjectMembersModel->member_id = $project_member;
                    $project_members_added=$ProjectMembersModel->save();
                    
                }
                
            }
        }

        
        if(isset($project_tasks)){
            foreach($project_tasks as $pt_key => $project_task){
                if($project_task!=""){
                    $ProjectTasksModel = new ProjectTasksModel();
                    $ProjectTasksModel->project_id = $project_id;
                    $ProjectTasksModel->project_task = $project_task;
                    $ProjectTasksModel->user_id = $project_task_users[$pt_key];
                    $ProjectTasksModel->added_by = Session::get('user')['user_id'];
                    $ProjectTasksModel->added_date = date("Y-m-d H:i:s");
                    $project_tasks_added=$ProjectTasksModel->save();
                    
                }
                
            }
        }

        
        if(isset($api_templates)){
            foreach($api_templates as $ati_key => $api_template){
                if($api_template!=""){
                    $ApiTemplatesItemsModel = new ApiTemplatesItemsModel();
                    $ApiTemplatesItemsModel->project_id = $project_id;
                    $ApiTemplatesItemsModel->template_item = $api_template;
                    $ApiTemplatesItemsModel->added_by = Session::get('user')['user_id'];
                    $ApiTemplatesItemsModel->added_date = date("Y-m-d H:i:s");
                    $api_template_items_added=$ApiTemplatesItemsModel->save();
                    
                }
                
            }
        }

        
        if(isset($selected_member_ids)){
            foreach($selected_member_ids as $pr_key => $selected_member_id){
                if($selected_member_id!=""){
                    $ProjectRolesModel = new ProjectRolesModel();
                    $ProjectRolesModel->project_id = $project_id;
                    $ProjectRolesModel->member_id = $selected_member_id;
                    $ProjectRolesModel->project_role = $selected_roles[$pr_key];
                    $ProjectRolesModel->estimate_hours = $selected_estimate_hours[$pr_key];
                    $project_roles_added=$ProjectRolesModel->save();
                    
                }
                
            }
        }


        
        if(isset($project_technologies)){
            foreach($project_technologies as $pr_key => $project_technology){
                if($project_technology!=""){
                    $ProjectTechnologiesModel = new ProjectTechnologiesModel();
                    $ProjectTechnologiesModel->project_id = $project_id;
                    $ProjectTechnologiesModel->technology_name = $project_technology;
                    $ProjectTechnologiesModel->added_by = Session::get('user')['user_id'];
                    $ProjectTechnologiesModel->added_date = date("Y-m-d H:i:s");
                    $project_technology_added=$ProjectTechnologiesModel->save();
                    
                }
                
            }
        }

        $response = array(
            'status' => true,
            'message' => "Project updated successfully."
        );

        echo json_encode($response);

    }

    //Delete Project Process
    public function deleteProjectProcess(Request $request)
    {
        $ProjectsModel = new ProjectsModel();
        

        $project_id= $request->get('project_id');

        $ProjectMembersModel = new ProjectMembersModel();
        $project_member_deleted = $ProjectMembersModel::where('project_id', $project_id)->delete();

        $ProjectTasksModel = new ProjectTasksModel();
        $project_task_deleted = $ProjectTasksModel::where('project_id', $project_id)->delete();

        $ApiTemplatesItemsModel = new ApiTemplatesItemsModel();
        $project_api_templates_deleted = $ApiTemplatesItemsModel::where('project_id', $project_id)->delete();

        $ProjectRolesModel = new ProjectRolesModel();
        $project_role_deleted = $ProjectRolesModel::where('project_id', $project_id)->delete();

        $ProjectTechnologiesModel = new ProjectTechnologiesModel();
        $project_technology_deleted = $ProjectTechnologiesModel::where('project_id', $project_id)->delete();
        
        // Delete Data
        $deleted = $ProjectsModel::where('project_id', $project_id)->delete();
            

        if($deleted){
            
            $response = array(
                'status' => true,
                'message' => "Project deleted successfully."
            );
        }else{
            
            $response = array(
                'status' => false,
                'message' => "Something went wrong."
            );
        }

        echo json_encode($response);
    }

    public function getProjectMemberList(Request $request){

        $ProjectsModel = new ProjectsModel();
        $UsersModel = new UsersModel();
        $ProjectRolesModel = new ProjectRolesModel();

        $project_id = "";

        $member_ids= $request->get('member_ids');

        if(isset($_POST['project_id'])){
            $project_id = $_POST['project_id'];

            $projects_roles =$ProjectRolesModel->get_project_roles_by_project_id($project_id);
        }

        

        $project_selected_members = $UsersModel->get_users_by_user_ids($member_ids);// Get All Projects

        ?>

        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="inputProjectMemberList">Project Member</label>
                    <select class="form-control" id="inputProjectMemberList" name="project_member_list" placeholder="">
                        <option value=""></option>
                        <?php foreach($project_selected_members as $project_selected_member){?>
                        <option value="<?php echo $project_selected_member->user_id;?>"><?php echo $project_selected_member->first_name.' '.$project_selected_member->last_name;?></option>
                        <?php } ?>
                    </select>
                    <span class="text-danger input-error project_member_list-error wizard-form-error"></span>
                    
                </div>
            </div>

            <div class="col-lg-3">
                <div class="form-group">
                    <label for="inputProjectMemberRole" >Project Role</label>
                    <input type="text" class="form-control" id="inputProjectMemberRole" name="project_member_role" placeholder="">
                    <span class="text-danger input-error project_member_role-error wizard-form-error"></span>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="form-group">
                    <label for="inputProjectEstimateHour">Estimate Hour(s)</label>
                    <input type="text" class="form-control" id="inputProjectEstimateHour" name="project_estimate_hour" placeholder="">
                    <span class="text-danger input-error project_estimate_hour-error wizard-form-error"></span>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="form-group">
                    <label>&nbsp;</label><br/>
                    <a class="addmore" style="cursor: pointer;" onclick="add_more_role()">
                        Add Role
                    </a>
                </div>
            </div>

            

        </div>

        <h5>Project Roles</h5>
        <hr/>

        <div class="row">
            <div class="col-lg-12">

                <table width="100%" class="table" id="projectRolesTable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Hours</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if(!empty($projects_roles)){?>
                            <?php foreach($projects_roles as $projects_role){
                                $user =$UsersModel->get_user_by_user_id($projects_role->member_id);
                                ?>
                                <tr data-row="">
                                    <td><?php echo $user->first_name.' '.$user->last_name;?>
                                        <input type="hidden" name="selected_member_ids[]" value="<?php echo $projects_role->member_id;?>">
                                    </td>
                                    <td><?php echo $projects_role->project_role;?>
                                        <input type="hidden" name="selected_roles[]" value="<?php echo $projects_role->project_role;?>">
                                    </td>
                                    <td><?php echo $projects_role->estimate_hours;?>
                                        <input type="hidden" name="selected_estimate_hours[]" value="<?php echo $projects_role->estimate_hours;?>">
                                    </td>
                                    <td><a onclick="remove_role(this)">Remove Role</a></td></tr>
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>


        <?php
        
        
    }


    public function assignTask($project_task_id){

        $ProjectsModel = new ProjectsModel();
        $UsersModel = new UsersModel();
        $ProjectTasksModel = new ProjectTasksModel();
        $leader_id = Session::get('user')['user_id'];

        $project_task = $ProjectTasksModel->get_task_by_project_task_id($project_task_id);
        
        $data['page_title'] = 'Task('.$project_task->project_task.')';
        $data['project_task_id'] = $project_task_id;
        $data['project_task'] = $project_task;
        $data['UsersModel'] = $UsersModel;

        return view('system/project/assign_task',$data);
        
    }

    
    public function assignUserFormAjax(Request $request)
    {
        $UsersModel = new UsersModel();

        $project_task_id = $request->get('project_task_id');

        $task_users = $UsersModel->get_all_active_users();

        $data['task_users'] = $task_users;
        $data['project_task_id'] = $project_task_id;

        return Response::json(array('element' => View::make('system/project/add_task_user_form_aj',$data)->render()));
    }

    public function updateTaskUserProcess(Request $request)
    {
        $UsersModel = new UsersModel();
        $ProjectTasksModel = new ProjectTasksModel();
        $session = session();

        $project_task_id= $request->get('project_task_id');
        $user_id= $request->get('user_id');

        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ],
        [
            'user_id.required' => 'User is required',
        ]);

        if ($validator->fails()) {
            
            return Response::json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            ), 422);
        }else{

            $updated = $ProjectTasksModel::where('project_task_id', $project_task_id)->update(
                array(
                    'user_id'   => $user_id,
                    'updated_by'   => Session::get('user')['user_id'],
                    'updated_date'   => date("Y-m-d H:i:s"),
                )
            );

            

            if($updated){
                
                $response = array(
                    'status' => true,
                    'message' => "User assigned successfully."
                );
            }else{
                
                $response = array(
                    'status' => false,
                    'message' => "Something went wrong."
                );
            }

            echo json_encode($response);
        }
    }
}
