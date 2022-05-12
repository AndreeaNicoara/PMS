<?php

namespace App\Http\Controllers\system\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator,Redirect,Response;
use App\Models\UsersModel;
use Session;
use View;


class AuthController extends Controller
{
    // Login Process
    public function loginAuthentication(Request $request){

        $UsersModel = new UsersModel();
        $session = session();

        $username= $request->get('username');//Create Variables
        $password= $request->get('password');//Create Variables

        $passwordMD5= md5($password);//Convert to MD5

        //Input Validations
        $validator = Validator::make($request->all(), [
            'username' => 'required|min:5|max:50',//Validation Rule
            'password' => 'required|min:5|max:50',//Validation Rule
        ],
        [
            'username.required' => 'Username is required',//Validation Message
            'username.min' => 'Username must be at least 5 characters length',//Validation Message
            'username.max' => 'Username cannot be exceed 50 characters length',//Validation Message
            'password.required' => 'Password is required',//Validation Message
            'password.min' => 'Password must be at least 5 characters length',//Validation Message
            'password.max' => 'Password cannot be exceed 50 characters length',//Validation Message
            
        ]);

        if ($validator->fails()) { // If Validation Failure
            // Failure Response Message
            return Response::json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            ), 422);
        }else{// If Validation Not Failure
            $userDetails = $UsersModel->where('username', $username)
                        ->where('password', $passwordMD5)
                        ->where('status', '0')
                        ->first();




            if(!empty($userDetails) && isset($userDetails->user_id)){

                

                // Add User Data to the Session    
                $session->put('user', [
                    'user_id' => $userDetails->user_id,
                    'first_name' => $userDetails->first_name, 
                    'last_name' => $userDetails->last_name, 
                    'user_type' => $userDetails->user_type, 
                    'isLoggedIn' => TRUE
                ]);
                // Success Response Message
                $response = array(
                    'status' => true,
                    'message' => "Login Successfull."
                );
                
            }else{
                // Failure Response Message   
                $response = array(
                    'status' => false,
                    'message' => "Please check your username and password."
                );
                 
            }
            echo json_encode($response);
        }

    }

    // Login Welcome Box
    public function loginFormAjax(Request $request)
    {

        return Response::json(array('element' => View::make('system/auth/login_form_aj')->render()));
        
    } 
    // Logout System
    public function logout(Request $request) {
        Auth::logout();
        Session::flush();
        return redirect('/');
    }

    //Register 
    public function signup(){
        return view('system/auth/signup');
    }

    // Login Process
    public function signupProcess(Request $request){

        $UsersModel = new UsersModel();
        $session = session();

        $first_name= $request->get('first_name');//Create Variables
        $last_name= $request->get('last_name');//Create Variables
        $username= $request->get('username');//Create Variables
        $password= $request->get('password');//Create Variables
        $password_confirmation= $request->get('password_confirmation');//Create Variables

        $passwordMD5= md5($password);//Convert to MD5

        //Input Validations
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|min:2|max:50',//Validation Rule
            'last_name' => 'required|min:2|max:50',//Validation Rule
            'username' => 'required|min:5|max:50',//Validation Rule
            'password' => 'required|confirmed|min:5|max:50',//Validation Rule
            
        ],
        [
            'first_name.required' => 'First name is required',//Validation Message
            'first_name.min' => 'Fist name must be at least 2 characters length',//Validation Message
            'first_name.max' => 'First name cannot be exceed 50 characters length',//Validation Message
            'last_name.required' => 'Last name is required',//Validation Message
            'last_name.min' => 'Last name must be at least 2 characters length',//Validation Message
            'last_name.max' => 'Last name cannot be exceed 50 characters length',//Validation Message
            'username.required' => 'Username is required',//Validation Message
            'username.min' => 'Username must be at least 5 characters length',//Validation Message
            'username.max' => 'Username cannot be exceed 50 characters length',//Validation Message
            'password.required' => 'Password is required',//Validation Message
            'password.confirmed' => 'Password did not match with confirm password field',//Validation Message
            'password.min' => 'Password must be at least 5 characters length',//Validation Message
            'password.max' => 'Password cannot be exceed 50 characters length',//Validation Message
            
        ]);

        if ($validator->fails()) { // If Validation Failure
            // Failure Response Message
            return Response::json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            ), 422);
        }else{// If Validation Not Failure

            // Assign All Data to Model
            $UsersModel->first_name = $first_name;
            $UsersModel->last_name = $last_name;
            $UsersModel->user_type = "USER";
            $UsersModel->username = $username;
            $UsersModel->password = md5($password);
            $UsersModel->confirmation_code = $password;
            $UsersModel->status = "0";
            $UsersModel->added_by = "0";
            $UsersModel->added_date = date("Y-m-d H:i:s");

            $added=$UsersModel->save();

            if($added){
                // Success Response Message
                $response = array(
                    'status' => true,
                    'message' => "User registered successfully."
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
}
