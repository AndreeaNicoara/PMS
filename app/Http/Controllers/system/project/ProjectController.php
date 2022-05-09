<?php

namespace App\Http\Controllers\system\project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//-- Dush 2022.05.03 OPENED--//
use Validator,Redirect,Response;
use View;
use App\Models\UsersModel;
use App\Models\ProjectsModel;
use App\Models\ProjectUsersModel;
use Session;
//-- Dush 2022.05.03 CLOSED--//

class ProjectController extends Controller
{
    // Project Management
    public function index(Request $request){

        $ProjectsModel = new ProjectsModel();//Load Model
        $UsersModel = new UsersModel();//Load Model

        $projects = $ProjectsModel->get_all_projects();// Get All Projects
        
        $data['page_title'] = 'Projects';// Define Page Title
        $data['projects'] = $projects;// Pass Projects Data to Data Array
        $data['UsersModel'] = $UsersModel;// Pass Users Model to Data Array

        return view('system/project/project',$data);
        
    }

    // Add Project Ajax View
    public function addProjectFormAjax(Request $request)
    {
        $UsersModel = new UsersModel();

        $project_managers = $UsersModel->get_all_active_users();

        $data['project_managers'] = $project_managers;

        return Response::json(array('element' => View::make('system/project/add_project_form_aj',$data)->render()));
    }

    //Add Project Process
    public function addProjectProcess(Request $request)
    {
        $ProjectsModel = new ProjectsModel();//Load Model
        $session = session();//Session Initialized

        //Assign Data To Variable
        $project_name= $request->get('project_name');
        $start_date= $request->get('start_date');
        $end_date= $request->get('end_date');
        $total_hours= $request->get('total_hours');
        $project_manager_id= $request->get('project_manager_id');
        $project_type= $request->get('project_type');
        $status= $request->get('status');

        //Input Validations
        $validator = Validator::make($request->all(), [
            'project_name' => 'required|min:2|max:200',//Validation Rule
            'start_date' => 'required',//Validation Rule
            'end_date' => 'required',//Validation Rule
            'total_hours' => 'required',//Validation Rule
            'project_manager_id' => 'required',//Validation Rule
            'project_type' => 'required',//Validation Rule
            'status' => 'required',//Validation Rule
        ],
        [
            'project_name.required' => 'Project name is required',//Validation Message
            'project_name.min' => 'Project name must be at least 2 characters length',//Validation Message
            'project_name.max' => 'First name cannot be exceed 200 characters length',//Validation Message
            'start_date.required' => 'Start date is required',//Validation Message
            'end_date.required' => 'End date is required',//Validation Message
            'total_hours.required' => 'Total hour is required',//Validation Message
            'project_manager_id.required' => 'Project manager is required',//Validation Message
            'project_type.required' => 'Project type is required',//Validation Message
            'status.required' => 'Status is required',//Validation Message
            
        ]);

        if ($validator->fails()) {// If Validation Failure
            // Failure Response Message
            return Response::json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            ), 422);
        }else{// If Validation Not Failure
            // Assign All Data to Model
            $ProjectsModel->project_name = $project_name;
            $ProjectsModel->start_date = $start_date;
            $ProjectsModel->end_date = $end_date;
            $ProjectsModel->total_hours = $total_hours;
            $ProjectsModel->project_manager_id = $project_manager_id;
            $ProjectsModel->project_type = $project_type;
            $ProjectsModel->status = $status;
            $ProjectsModel->added_by = Session::get('user')['user_id'];
            $ProjectsModel->added_date = date("Y-m-d H:i:s");

            $added=$ProjectsModel->save();

            if($added){
                // Success Response Message
                $response = array(
                    'status' => true,
                    'message' => "Project added successfully."
                );
            }else{
                // Failure Response Message
                $response = array(
                    'status' => false,
                    'message' => "Something went wrong."
                );
            }

            echo json_encode($response);
        }
    }

    // Edit Project Ajax Page
    public function editProjectFormAjax(Request $request)
    {
        $project_id = $request->get('project_id');// Assign Project Id to Variable

        $UsersModel = new UsersModel;//Load Model
        $ProjectsModel = new ProjectsModel();//Load Model

        $project = $ProjectsModel->get_project_by_project_id($project_id);//Get Project Details By Project Id

        $project_managers = $UsersModel->get_all_active_users();//Get All Users

        $data['project_managers'] = $project_managers;// Pass Project Manager Data to the $Data Array
        $data['project'] = $project;// Pass Project Data to the $Data Array

        return Response::json(array('element' => View::make('system/project/edit_project_form_aj',$data)->render()));
    }

    // Edit User Process
    public function updateProjectProcess(Request $request)
    {
        $ProjectsModel = new ProjectsModel();// Load Model
        $session = session();

        //Assign Data To Variable
        $project_id= $request->get('project_id');
        $project_name= $request->get('project_name');
        $start_date= $request->get('start_date');
        $end_date= $request->get('end_date');
        $total_hours= $request->get('total_hours');
        $project_manager_id= $request->get('project_manager_id');
        $project_type= $request->get('project_type');
        $status= $request->get('status');

        //Input Validations
        $validator = Validator::make($request->all(), [
            'project_name' => 'required|min:2|max:200',//Validation Rule
            'start_date' => 'required',//Validation Rule
            'end_date' => 'required',//Validation Rule
            'total_hours' => 'required',//Validation Rule
            'project_manager_id' => 'required',//Validation Rule
            'project_type' => 'required',//Validation Rule
            'status' => 'required',//Validation Rule
        ],
        [
            'project_name.required' => 'Project name is required',//Validation Message
            'project_name.min' => 'Project name must be at least 2 characters length',//Validation Message
            'project_name.max' => 'First name cannot be exceed 200 characters length',//Validation Message
            'start_date.required' => 'Start date is required',//Validation Message
            'end_date.required' => 'End date is required',//Validation Message
            'total_hours.required' => 'Total hour is required',//Validation Message
            'project_manager_id.required' => 'Project manager is required',//Validation Message
            'project_type.required' => 'Project type is required',//Validation Message
            'status.required' => 'Status is required',//Validation Message
            
        ]);

        if ($validator->fails()) {// If Validation Failure
            // Failure Response Message
            return Response::json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            ), 422);
        }else{// If Validation Not Failure
            // Update Data
            $updated = $ProjectsModel::where('project_id', $project_id)->update(
                array(
                    'project_name'   => $project_name,
                    'start_date'   => $start_date,
                    'end_date'   => $end_date,
                    'total_hours'   => $total_hours,
                    'project_manager_id'   => $project_manager_id,
                    'project_type'   => $project_type,
                    'status'   => $status,
                    'updated_by'   => Session::get('user')['user_id'],
                    'updated_date'   => date("Y-m-d H:i:s"),
                )
            );
            

            if($updated){
                // Success Response Message
                $response = array(
                    'status' => true,
                    'message' => "Project updated successfully."
                );
            }else{
                // Failure Response Message 
                $response = array(
                    'status' => false,
                    'message' => "Something went wrong."
                );
            }

            echo json_encode($response);
        }
    }

    //Delete Project Process
    public function deleteProjectProcess(Request $request)
    {
        $ProjectsModel = new ProjectsModel();
        

        $project_id= $request->get('project_id');
        // Delete Data
        $deleted = $ProjectsModel::where('project_id', $project_id)->delete();
            

        if($deleted){
            // Success Response Message
            $response = array(
                'status' => true,
                'message' => "Project deleted successfully."
            );
        }else{
            // Failure Response Message
            $response = array(
                'status' => false,
                'message' => "Something went wrong."
            );
        }

        echo json_encode($response);
    }

    public function getProjectMemberList(Request $request){

        $ProjectsModel = new ProjectsModel();//Load Model
        $UsersModel = new UsersModel();//Load Model

        $member_ids= $request->get('member_ids');

        $project_selected_members = $UsersModel->get_users_by_user_ids($member_ids);// Get All Projects

        ?>

        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="inputProjectMemberList" class="wizard-form-text-label">Project Member</label>
                    <select class="form-control" id="inputProjectMemberList" name="project_member_list" placeholder="">
                        <option value=""></option>
                        <?php foreach($project_selected_members as $project_selected_member){?>
                        <option value="<?php echo $project_selected_member->user_id;?>"><?php echo $project_selected_member->first_name.' '.$project_selected_member->last_name;?></option>
                        <?php } ?>
                    </select>
                    
                </div>
            </div>

            <div class="col-lg-3">
                <div class="form-group">
                    <label for="inputProjectMemberRole" class="wizard-form-text-label">Project Role</label>
                    <input type="text" class="form-control" id="inputProjectMemberRole" name="project_member_role" placeholder="">
                </div>
            </div>

            <div class="col-lg-3">
                <div class="form-group">
                    <label for="inputProjectEstimateHour" class="wizard-form-text-label">Estimate Hour(s)</label>
                    <input type="text" class="form-control" id="inputProjectEstimateHour" name="project_estimate_hour" placeholder="">
                </div>
            </div>

            <div class="col-lg-2">
                <div class="form-group">
                    <a class="addmore" style="cursor: pointer;" onclick="add_more_role()">&nbsp;
                        Add More Role
                    </a>
                </div>
            </div>

            

        </div>

        <h5>Project Roles</h5>
        <hr/>

        <div class="row">
            <div class="col-lg-4">

                <table width="100%">
                    <thead>
                        <th>
                            <td>Name</td>
                            <td>Role</td>
                            <td>Hours</td>
                        </th>
                    </thead>

                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>


        <?php
        
        // $data['page_title'] = 'Projects';// Define Page Title
        // $data['projects'] = $projects;// Pass Projects Data to Data Array
        // $data['UsersModel'] = $UsersModel;// Pass Users Model to Data Array

        // return view('system/project/project',$data);
        
    }
}
