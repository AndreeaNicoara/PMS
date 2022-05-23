<?php

namespace App\Http\Controllers\system\main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProjectTasksModel;
use Session;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    //Main dashboard
    public function index(Request $request){

        $ProjectTasksModel = new ProjectTasksModel();//Load model

        if(Session()->has('user')){

            $user_id = Session::get('user')['user_id'];//Get user ID by session

            $new_tasks_count = $ProjectTasksModel->get_all_new_tasks_count_by_user_id($user_id);//Get new task count
            $open_tasks_count = $ProjectTasksModel->get_all_open_tasks_count_by_user_id($user_id);//Get opened task count
            $inprogress_tasks_count = $ProjectTasksModel->get_all_inprogress_tasks_count_by_user_id($user_id);//Get Inprogress task count
            $completed_tasks_count = $ProjectTasksModel->get_all_completed_tasks_count_by_user_id($user_id);//Get completed task count

            $pending_tasks = $ProjectTasksModel->get_all_pending_task_by_user_id($user_id);//Get all the pending tasks(not completed)

            $data['page_title'] = 'Dashboard';//Define page title
            $data['pending_tasks'] = $pending_tasks;//Put pending task to $data array

            $data['new_tasks_count'] = $new_tasks_count;//Put new task to $data array
            $data['open_tasks_count'] = $open_tasks_count;//Put open task to $data array
            $data['inprogress_tasks_count'] = $inprogress_tasks_count;//Put Inprogress task to $data array
            $data['completed_tasks_count'] = $completed_tasks_count;//Put completed task to $data array

            return view('system/main/dashboard',$data);
        }else{
            return redirect('/');
        }
    }
}
