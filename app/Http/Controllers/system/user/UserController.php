<?php

namespace App\Http\Controllers\system\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use Validator,Redirect,Response;
use View;
use App\Models\UsersModel;
use Session;


class UserController extends Controller
{
    // User Management
    public function index(Request $request){

        $UsersModel = new UsersModel();//Load Model

        $users = $UsersModel->get_all_users();// Get All Users
        
        $data['page_title'] = 'Users';// Define Page Title
        $data['users'] = $users;// Pass Users Data to Data Array

        return view('system/user/user',$data);
        
    }

    // Add User Ajax View
    public function addUserFormAjax(Request $request)
    {
        return Response::json(array('element' => View::make('system/user/add_user_form_aj')->render()));
    }

    //Add User Process
    public function addUserProcess(Request $request)
    {
        $UsersModel = new UsersModel();//Load Model
        $session = session();//Session Initialized

        //Assign Data To Variable
        $first_name= $request->get('first_name');
        $last_name= $request->get('last_name');
        $user_type= $request->get('user_type');
        $username= $request->get('username');
        $password= $request->get('password');
        $status= $request->get('status');

        //Input Validations
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|min:2|max:50',//Validation Rule
            'last_name' => 'required|min:2|max:50',//Validation Rule
            'user_type' => 'required',//Validation Rule
            'username' => 'required|min:5|max:50',//Validation Rule
            'password' => 'required|min:5|max:50',//Validation Rule
            'status' => 'required',//Validation Rule
        ],
        [
            'first_name.required' => 'First name is required',//Validation Message
            'first_name.min' => 'Fist name must be at least 2 characters length',//Validation Message
            'first_name.max' => 'First name cannot be exceed 50 characters length',//Validation Message
            'last_name.required' => 'Last name is required',//Validation Message
            'last_name.min' => 'Last name must be at least 2 characters length',//Validation Message
            'last_name.max' => 'Last name cannot be exceed 50 characters length',//Validation Message
            'user_type.required' => 'User type is required',//Validation Message
            'login.required' => 'Username is required',//Validation Message
            'login.min' => 'Username must be at least 5 characters length',//Validation Message
            'login.max' => 'Username cannot be exceed 50 characters length',//Validation Message
            'password.required' => 'Password is required',//Validation Message
            'password.min' => 'Password must be at least 5 characters length',//Validation Message
            'password.max' => 'Password cannot be exceed 50 characters length',//Validation Message
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
            $UsersModel->first_name = $first_name;
            $UsersModel->last_name = $last_name;
            $UsersModel->user_type = $user_type;
            $UsersModel->username = $username;
            $UsersModel->password = md5($password);
            $UsersModel->confirmation_code = $password;
            $UsersModel->status = $status;
            $UsersModel->added_by = Session::get('user')['user_id'];
            $UsersModel->added_date = date("Y-m-d H:i:s");

            $added=$UsersModel->save();

            if($added){
                // Success Response Message
                $response = array(
                    'status' => true,
                    'message' => "User added successfully."
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

    // Edit User Ajax Page
    public function editUserFormAjax(Request $request)
    {
        $user_id = $request->get('user_id');// Assign User Id to Variable

        $UsersModel = new UsersModel;//Load Model

        $user = $UsersModel->get_user_by_user_id($user_id);//Get User Details By User Id

        $data['user'] = $user;// Pass User Data to the $Data Array
        return Response::json(array('element' => View::make('system/user/edit_user_form_aj',$data)->render()));
    }

    // Edit User Process
    public function updateUserProcess(Request $request)
    {
        $UsersModel = new UsersModel();// Load Model
        $session = session();

        //Assign Data To Variable
        $user_id= $request->get('user_id');
        $first_name= $request->get('first_name');
        $last_name= $request->get('last_name');
        $user_type= $request->get('user_type');
        $username= $request->get('username');
        $password= $request->get('password');
        $status= $request->get('status');

        //Input Validations
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|min:2|max:50',//Validation Rule
            'last_name' => 'required|min:2|max:50',//Validation Rule
            'user_type' => 'required',//Validation Rule
            'username' => 'required|min:5|max:50',//Validation Rule
            'password' => 'required|min:5|max:50',//Validation Rule
            'status' => 'required',//Validation Rule
        ],
        [
            'first_name.required' => 'First name is required',//Validation Message
            'first_name.min' => 'Fist name must be at least 2 characters length',//Validation Message
            'first_name.max' => 'First name cannot be exceed 50 characters length',//Validation Message
            'last_name.required' => 'Last name is required',//Validation Message
            'last_name.min' => 'Last name must be at least 2 characters length',//Validation Message
            'last_name.max' => 'Last name cannot be exceed 50 characters length',//Validation Message
            'user_type.required' => 'User type is required',//Validation Message
            'login.required' => 'Username is required',//Validation Message
            'login.min' => 'Username must be at least 5 characters length',//Validation Message
            'login.max' => 'Username cannot be exceed 50 characters length',//Validation Message
            'password.required' => 'Password is required',//Validation Message
            'password.min' => 'Password must be at least 5 characters length',//Validation Message
            'password.max' => 'Password cannot be exceed 50 characters length',//Validation Message
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
            $updated = $UsersModel::where('user_id', $user_id)->update(
                array(
                    'first_name'   => $first_name,
                    'last_name'   => $last_name,
                    'user_type'   => $user_type,
                    'username'   => $username,
                    'password'   => md5($password),
                    'confirmation_code'   => $password,
                    'status'   => $status,
                    'updated_by'   => Session::get('user')['user_id'],
                    'updated_date'   => date("Y-m-d H:i:s"),
                )
            );
            

            if($updated){
                // Success Response Message
                $response = array(
                    'status' => true,
                    'message' => "User updated successfully."
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

    //Delete User Process
    public function deleteUserProcess(Request $request)
    {
        $UsersModel = new UsersModel();
        

        $user_id= $request->get('user_id');

        // Delete Data
        $deleted = $UsersModel::where('user_id', $user_id)->delete();
            

        if($deleted){
            // Success Response Message
            $response = array(
                'status' => true,
                'message' => "User deleted successfully."
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
