<?php

namespace App\Http\Controllers\system\project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use Validator,Redirect,Response;
use View;
use App\Models\UsersModel;
use App\Models\ProjectsModel;
use App\Models\ProjectUsersModel;
use Session;


class MyProjectController extends Controller
{
    // Task Management
    // public function task(Request $request){

    //     $ProjectsModel = new ProjectsModel();//Load Model
    //     $UsersModel = new UsersModel();//Load Model

    //     $user_id = Session::get('user')['user_id'];//Get User Id From 

    //     $my_projects = $ProjectsModel->get_all_my_projects($user_id);//Get All Project By User Id

    //     $data['page_title'] = 'My Projects';
    //     $data['my_projects'] = $my_projects;
    //     $data['UsersModel'] = $UsersModel;

    //     return view('system/project/my_project',$data);

    // }
    /*public function assignUser(Request $request){

        $ProjectsModel = new ProjectsModel();
        $UsersModel = new UsersModel();

        $user_id = Session::get('user')['user_id'];

        $my_projects = $ProjectsModel->get_all_my_projects($user_id);
        
        $data['page_title'] = 'Assign User';
        $data['my_projects'] = $my_projects;
        $data['UsersModel'] = $UsersModel;

        return view('system/project/assign_user',$data);
        
    }*/

    /*public function assignUserView($project_id){

        $ProjectsModel = new ProjectsModel();
        $UsersModel = new UsersModel();
        $ProjectUsersModel = new ProjectUsersModel();

        $user_id = Session::get('user')['user_id'];


        $not_assign_project_users = $ProjectUsersModel->get_all_assign_project_users($project_id);
        $project = $ProjectsModel->get_project_by_project_id($project_id);
        
        $data['page_title'] = 'Assign User View - '.$project->project_name;
        $data['not_assign_project_users'] = $not_assign_project_users;
        $data['project'] = $project;

        return view('system/project/assign_user_view',$data);
        
    }*/

    /*public function addProjectUserFormAjax(Request $request)
    {
        $UsersModel = new UsersModel();

        $project_id = $request->get('project_id');

        $project_users = $UsersModel->get_all_active_users();

        $data['project_users'] = $project_users;
        $data['project_id'] = $project_id;

        return Response::json(array('element' => View::make('system/project/add_project_user_form_aj',$data)->render()));
    }*/

    /*public function addProjectUserProcess(Request $request)
    {
        $ProjectsModel = new ProjectsModel();
        $ProjectUsersModel = new ProjectUsersModel();
        $session = session();

        $project_user_id= $request->get('project_user_id');
        $project_id= $request->get('project_id');

        $validator = Validator::make($request->all(), [
            'project_user_id' => 'required',
        ],
        [
            'project_user_id.required' => 'Project user is required',
            
        ]);

        if ($validator->fails()) {
            return Response::json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            ), 422);
        }else{
            $ProjectUsersModel->project_id = $project_id;
            $ProjectUsersModel->user_id = $project_user_id;

            $added=$ProjectUsersModel->save();

            if($added){
                $response = array(
                    'status' => true,
                    'message' => "Project user added successfully."
                );
            }else{
                $response = array(
                    'status' => false,
                    'message' => "Something went wrong."
                );
            }

            echo json_encode($response);
        }
    }*/


    /*public function deleteProjectUserProcess(Request $request)
    {
        $ProjectUsersModel = new ProjectUsersModel();
        

        $project_users_id= $request->get('project_users_id');

        $deleted = $ProjectUsersModel::where('project_users_id', $project_users_id)->delete();
            

        if($deleted){
            $response = array(
                'status' => true,
                'message' => "Project user deleted successfully."
            );
        }else{
            $response = array(
                'status' => false,
                'message' => "Something went wrong."
            );
        }

        echo json_encode($response);
    }*/
}
