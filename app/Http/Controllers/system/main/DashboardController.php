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
    
    
    public function index(Request $request){

        $ProjectTasksModel = new ProjectTasksModel();

        if(Session()->has('user')){

            $user_id = Session::get('user')['user_id'];

            $new_tasks_count = $ProjectTasksModel->get_all_new_tasks_count_by_user_id($user_id);
            $open_tasks_count = $ProjectTasksModel->get_all_open_tasks_count_by_user_id($user_id);
            $inprogress_tasks_count = $ProjectTasksModel->get_all_inprogress_tasks_count_by_user_id($user_id);
            $completed_tasks_count = $ProjectTasksModel->get_all_completed_tasks_count_by_user_id($user_id);

            $pending_tasks = $ProjectTasksModel->get_all_pending_task_by_user_id($user_id);

            $data['page_title'] = 'Dashboard';
            $data['pending_tasks'] = $pending_tasks;

            $data['new_tasks_count'] = $new_tasks_count;
            $data['open_tasks_count'] = $open_tasks_count;
            $data['inprogress_tasks_count'] = $inprogress_tasks_count;
            $data['completed_tasks_count'] = $completed_tasks_count;

            return view('system/main/dashboard',$data);
        }else{
            return redirect('/');
        }
    }
}
