<?php

namespace App\Http\Controllers\system\leader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LeadersModel;

use Validator,Redirect,Response;
use View;
use Session;

class LeaderConroller extends Controller
{
    public function index(Request $request){

        $LeadersModel = new LeadersModel();

        $leaders = $LeadersModel->get_all_leaders();

        $data['page_title'] = 'Leaders';
        $data['leaders'] = $leaders;

        return view('system/leader/leader',$data);

        
    }

    public function addLeaderFormAjax(Request $request)
    {
        $LeadersModel = new LeadersModel();

        $leaders = $LeadersModel->get_all_leaders();

        $leader_ids=[];

        foreach($leaders as $leader){
            $leader_ids[] = $leader->user_id; 
        }
        

        $users = $LeadersModel->get_all_not_assign_leaders($leader_ids);

        $data['users'] = $users;

        return Response::json(array('element' => View::make('system/leader/add_leader_form_aj',$data)->render()));
    }

    public function addLeaderProcess(Request $request)
    {
        $LeadersModel = new LeadersModel();
        $session = session();

        $user_id= $request->get('user_id');
        $status= $request->get('status');

        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'status' => 'required',
        ],
        [
            'user_id.required' => 'User is required',
            'status.required' => 'Status is required',
        ]);

        if ($validator->fails()) {
            return Response::json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            ), 422);
        }else{
            $LeadersModel->user_id = $user_id;
            $LeadersModel->status = $status;
            $LeadersModel->added_by = Session::get('user')['user_id'];
            $LeadersModel->added_date = date("Y-m-d H:i:s");

            $added=$LeadersModel->save();

            if($added){
                $response = array(
                    'status' => true,
                    'message' => "Leader added successfully."
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

    // Update Leader Ajax Page
    public function updateLeaderFormAjax(Request $request)
    {
        $leader_id = $request->get('leader_id');// Assign Project Id to Variable

        $LeadersModel = new LeadersModel();

        $leader_data = $LeadersModel->get_leader_by_leader_id($leader_id);//Get Leader Details By Leader Id

        $leaders = $LeadersModel->get_all_leaders();

        $leader_ids=[];

        foreach($leaders as $leader){
            if($leader_data->user_id!=$leader->user_id){
                $leader_ids[] = $leader->user_id; 
            }
        }
        

        $users = $LeadersModel->get_all_not_assign_leaders($leader_ids,$leader_id);

        $data['users'] = $users;
        $data['leader'] = $leader;

        return Response::json(array('element' => View::make('system/leader/update_leader_form_aj',$data)->render()));
    }


    // Update Leader Process
    public function updateLeaderProcess(Request $request)
    {
        $LeadersModel = new LeadersModel();// Load Model
        $session = session();

        //Assign Data To Variable
        $leader_id= $request->get('leader_id');
        $user_id= $request->get('user_id');
        $status= $request->get('status');

        //Input Validations
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'status' => 'required',
        ],
        [
            'user_id.required' => 'User is required',
            'status.required' => 'Status is required',
        ]);

        if ($validator->fails()) {// If Validation Failure
            // Failure Response Message
            return Response::json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            ), 422);
        }else{// If Validation Not Failure
            // Update Data
            $updated = $LeadersModel::where('leader_id', $leader_id)->update(
                array(
                    'user_id'   => $user_id,
                    'status'   => $status,
                    'updated_by'   => Session::get('user')['user_id'],
                    'updated_date'   => date("Y-m-d H:i:s"),
                )
            );
            

            if($updated){
                // Success Response Message
                $response = array(
                    'status' => true,
                    'message' => "Leader updated successfully."
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


    public function deleteLeaderProcess(Request $request)
    {
        $LeadersModel = new LeadersModel();
        

        $leader_id= $request->get('leader_id');

        $deleted = $LeadersModel::where('leader_id', $leader_id)->delete();
            

        if($deleted){
            $response = array(
                'status' => true,
                'message' => "Leader deleted successfully."
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
