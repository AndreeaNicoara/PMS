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
    public function index(Request $request){

        $UsersModel = new UsersModel();

        $users = $UsersModel->get_all_users();
        
        $data['page_title'] = 'Users';
        $data['users'] = $users;

        return view('system/user/user',$data);
        
    }

    public function addUserFormAjax(Request $request)
    {
        return Response::json(array('element' => View::make('system/user/add_user_form_aj')->render()));
    }

    public function addUserProcess(Request $request)
    {
        $UsersModel = new UsersModel();
        $session = session();

        $first_name= $request->get('first_name');
        $last_name= $request->get('last_name');
        $user_type= $request->get('user_type');
        $username= $request->get('username');
        $password= $request->get('password');
        $status= $request->get('status');

        
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|min:2|max:50',
            'last_name' => 'required|min:2|max:50',
            'user_type' => 'required',
            'username' => 'required|min:5|max:50',
            'password' => 'required|min:5|max:50',
            'status' => 'required',
        ],
        [
            'first_name.required' => 'First name is required',
            'first_name.min' => 'Fist name must be at least 2 characters',
            'first_name.max' => 'First name cannot exceed 50 characters',
            'last_name.required' => 'Last name is required',
            'last_name.min' => 'Last name must be at least 2 characters',
            'last_name.max' => 'Last name cannot exceed 50 characters',
            'user_type.required' => 'User type is required',
            'login.required' => 'Username is required',
            'login.min' => 'Username must be at least 5 characters',
            'login.max' => 'Username cannot exceed 50 characters',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 5 characters',
            'password.max' => 'Password cannot exceed 50 characters',
            'status.required' => 'Status is required',
            
        ]);

        if ($validator->fails()) {
            
            return Response::json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            ), 422);
        }else{

            
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
                
                $response = array(
                    'status' => true,
                    'message' => "User added successfully."
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

    public function editUserFormAjax(Request $request)
    {
        $user_id = $request->get('user_id');

        $UsersModel = new UsersModel;

        $user = $UsersModel->get_user_by_user_id($user_id);

        $data['user'] = $user;
        return Response::json(array('element' => View::make('system/user/edit_user_form_aj',$data)->render()));
    }

    public function updateUserProcess(Request $request)
    {
        $UsersModel = new UsersModel();
        $session = session();

        $user_id= $request->get('user_id');
        $first_name= $request->get('first_name');
        $last_name= $request->get('last_name');
        $user_type= $request->get('user_type');
        $username= $request->get('username');
        $password= $request->get('password');
        $status= $request->get('status');

        
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|min:2|max:50',
            'last_name' => 'required|min:2|max:50',
            'user_type' => 'required',
            'username' => 'required|min:5|max:50',
            'password' => 'required|min:5|max:50',
            'status' => 'required',
        ],
        [
            'first_name.required' => 'First name is required',
            'first_name.min' => 'Fist name must be at least 2 characters',
            'first_name.max' => 'First name cannot exceed 50 characters',
            'last_name.required' => 'Last name is required',
            'last_name.min' => 'Last name must be at least 2 characters',
            'last_name.max' => 'Last name cannot exceed 50 characters',
            'user_type.required' => 'User type is required',
            'login.required' => 'Username is required',
            'login.min' => 'Username must be at least 5 characters',
            'login.max' => 'Username cannot exceed 50 characters',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 5 characters',
            'password.max' => 'Password cannot exceed 50 characters',
            'status.required' => 'Status is required',
            
        ]);

        if ($validator->fails()) {
            
            return Response::json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            ), 422);
        }else{

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
                
                $response = array(
                    'status' => true,
                    'message' => "User updated successfully."
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

    public function deleteUserProcess(Request $request)
    {
        $UsersModel = new UsersModel();
        

        $user_id= $request->get('user_id');

        $deleted = $UsersModel::where('user_id', $user_id)->delete();
            

        if($deleted){
            
            $response = array(
                'status' => true,
                'message' => "User deleted successfully."
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
