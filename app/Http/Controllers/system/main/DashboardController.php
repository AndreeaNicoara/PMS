<?php

namespace App\Http\Controllers\system\main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TasksModel;
use Session;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
       // $this->username = $this->findUsername();
    }
    
    // Main Dashboard
    public function index(Request $request){

        $TasksModel = new TasksModel();//Load Model

        if(Session()->has('user')){

            $user_id = Session::get('user')['user_id'];// get user id by session

            $new_tasks_count = 0;//$TasksModel->get_all_new_tasks_count_by_user_id($user_id);// Get New Task Count
            $open_tasks_count = 0;//$TasksModel->get_all_open_tasks_count_by_user_id($user_id);// Get Opened Task Count
            $inprogress_tasks_count = 0;//$TasksModel->get_all_inprogress_tasks_count_by_user_id($user_id);// Get Inprogress Task Count
            $completed_tasks_count = 0;//$TasksModel->get_all_completed_tasks_count_by_user_id($user_id);// Get Completed Task Count

            $pending_tasks = array();//$TasksModel->get_all_pending_task_by_user_id($user_id);// Get All the Pending Tasks(Not Completed)

            $data['page_title'] = 'Dashboard';// Define Page Title
            $data['pending_tasks'] = $pending_tasks;// Put Pending Task to $data array

            $data['new_tasks_count'] = $new_tasks_count;// Put New Task to $data array
            $data['open_tasks_count'] = $open_tasks_count;// Put Open Task to $data array
            $data['inprogress_tasks_count'] = $inprogress_tasks_count;// Put Inprogress Task to $data array
            $data['completed_tasks_count'] = $completed_tasks_count;// Put Completed Task to $data array

            return view('system/main/dashboard',$data);
        }else{
            return redirect('/');
        }
    }
}
