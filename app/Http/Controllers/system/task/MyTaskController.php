<?php

namespace App\Http\Controllers\system\task;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//-- Dush 2022.05.03 OPENED--//
use Validator,Redirect,Response;
use View;
use App\Models\UsersModel;
use App\Models\ProjectsModel;
use App\Models\ProjectUsersModel;
use App\Models\TasksModel;
use Session;
//-- Dush 2022.05.03 CLOSED--//

class MyTaskController extends Controller
{
    public function index(Request $request){

        $ProjectsModel = new ProjectsModel();
        $UsersModel = new UsersModel();
        $TasksModel = new TasksModel();

        $user_id = Session::get('user')['user_id'];

        $tasks = $TasksModel->get_all_tasks_by_user_id($user_id);
        
        $data['page_title'] = 'My Task';
        $data['tasks'] = $tasks;
        $data['UsersModel'] = $UsersModel;

        return view('system/task/my_task',$data);
        
    }

    public function addTaskFormAjax(Request $request)
    {
        $ProjectUsersModel = new ProjectUsersModel();


        $user_id = Session::get('user')['user_id'];

        $projects = $ProjectUsersModel->get_all_assign_project_by_user_id($user_id);

        $data['projects'] = $projects;

        return Response::json(array('element' => View::make('system/task/add_task_form_aj',$data)->render()));
    }

    public function addTaskProcess(Request $request)
    {
        $TasksModel = new TasksModel();
        $session = session();

        $user_id = Session::get('user')['user_id'];

        $project_id= $request->get('project_id');
        $task_name= $request->get('task_name');
        $start_date= $request->get('start_date');
        $end_date= $request->get('end_date');
        $project_manager_id= $request->get('project_manager_id');
        $status= $request->get('status');

        $validator = Validator::make($request->all(), [
            'project_id' => 'required',
            'task_name' => 'required|min:2|max:200',
            'start_date' => 'required',
            'end_date' => 'required',
            'status' => 'required',
        ],
        [
            'project_id.required' => 'Project is required',
            'task_name.required' => 'Task name is required',
            'task_name.min' => 'Task name must be at least 2 characters length',
            'task_name.max' => 'Task name cannot be exceed 200 characters length',
            'start_date.required' => 'Start date is required',
            'end_date.required' => 'End date is required',
            'project_manager_id.required' => 'Project manager is required',
            'status.required' => 'Status is required',
            
        ]);

        if ($validator->fails()) {
            return Response::json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            ), 422);
        }else{
            $TasksModel->project_id = $project_id;
            $TasksModel->user_id = $user_id;
            $TasksModel->task_name = $task_name;
            $TasksModel->start_date = $start_date;
            $TasksModel->end_date = $end_date;
            $TasksModel->status = $status;
            $TasksModel->added_by = $user_id;
            $TasksModel->added_date = date("Y-m-d H:i:s");

            $added=$TasksModel->save();

            if($added){
                $response = array(
                    'status' => true,
                    'message' => "Task added successfully."
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

    public function editTaskFormAjax(Request $request)
    {
        $task_id = $request->get('task_id');
        $user_id = Session::get('user')['user_id'];

        
        $TasksModel = new TasksModel();
        $ProjectUsersModel = new ProjectUsersModel();

        $task = $TasksModel->get_task_by_task_id($task_id);

        $projects = $ProjectUsersModel->get_all_assign_project_by_user_id($user_id);

        $data['projects'] = $projects;
        $data['task'] = $task;

        return Response::json(array('element' => View::make('system/task/edit_task_form_aj',$data)->render()));
    }


    public function updateTaskProcess(Request $request)
    {
        $TasksModel = new TasksModel();
        $session = session();

        $user_id = Session::get('user')['user_id'];

        $task_id= $request->get('task_id');
        $project_id= $request->get('project_id');
        $task_name= $request->get('task_name');
        $start_date= $request->get('start_date');
        $end_date= $request->get('end_date');
        $project_manager_id= $request->get('project_manager_id');
        $status= $request->get('status');

        $validator = Validator::make($request->all(), [
            'project_id' => 'required',
            'task_name' => 'required|min:2|max:200',
            'start_date' => 'required',
            'end_date' => 'required',
            'status' => 'required',
        ],
        [
            'project_id.required' => 'Project is required',
            'task_name.required' => 'Task name is required',
            'task_name.min' => 'Task name must be at least 2 characters length',
            'task_name.max' => 'Task name cannot be exceed 200 characters length',
            'start_date.required' => 'Start date is required',
            'end_date.required' => 'End date is required',
            'project_manager_id.required' => 'Project manager is required',
            'status.required' => 'Status is required',
            
        ]);

        if ($validator->fails()) {
            return Response::json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            ), 422);
        }else{

            $updated = $TasksModel::where('task_id', $task_id)->update(
                array(
                    'project_id'   => $project_id,
                    'task_name'   => $task_name,
                    'start_date'   => $start_date,
                    'end_date'   => $end_date,
                    'status'   => $status,
                    'updated_by'   => Session::get('user')['user_id'],
                    'updated_date'   => date("Y-m-d H:i:s"),
                )
            );
            

            if($updated){
                $response = array(
                    'status' => true,
                    'message' => "Task updated successfully."
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


    public function deleteTaskProcess(Request $request)
    {
        $ProjectsModel = new ProjectsModel();
        

        $project_id= $request->get('project_id');

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
}
