<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('system.auth.login');//Landing page Routes to login (view)  page
});

Route::post('/login-authentication', [App\Http\Controllers\system\auth\AuthController::class, 'loginAuthentication']);//Routes For Login Authnticaton When Submit
Route::post('/login-form-ajax', [App\Http\Controllers\system\auth\AuthController::class, 'loginFormAjax']);// Routes for Login Welcome Box
Route::get('/logout', [App\Http\Controllers\system\auth\AuthController::class, 'logout']);// Routes for Logout

Route::get('/signup', [App\Http\Controllers\system\auth\AuthController::class, 'signup']);//Routes For Register
Route::post('/signup-process', [App\Http\Controllers\system\auth\AuthController::class, 'signupProcess']);//Routes For Signup Process When Submit

Route::group(['middleware' => 'web'], function () {
    Auth::routes();
    
    Route::get('/dashboard', [App\Http\Controllers\system\main\DashboardController::class, 'index']);// Routes for Main Dashboard

    //****User Management Rotes Here****//
    Route::get('/manage/user', [App\Http\Controllers\system\user\UserController::class, 'index']);//Routes for User Management Page
    Route::post('/add-user-form-ajax', [App\Http\Controllers\system\user\UserController::class, 'addUserFormAjax']);// Routes for Add User Ajax Page
    Route::post('/add-user-process', [App\Http\Controllers\system\user\UserController::class, 'addUserProcess']);// Routes for Add User Process
    Route::post('/edit-user-form-ajax', [App\Http\Controllers\system\user\UserController::class, 'editUserFormAjax']);// Routes for Update User Ajax Page
    Route::post('/update-user-process', [App\Http\Controllers\system\user\UserController::class, 'updateUserProcess']);// Routes for Update User Process
    Route::post('/delete-user-process', [App\Http\Controllers\system\user\UserController::class, 'deleteUserProcess']);// Routes for Delete User Process



    //****Project Management Rotes Here****//
    Route::get('/manage/project', [App\Http\Controllers\system\project\ProjectController::class, 'index']);//Routes for Project Management Page
    Route::post('/add-project-form-ajax', [App\Http\Controllers\system\project\ProjectController::class, 'addProjectFormAjax']);// Routes for Add Project Ajax Page
    Route::post('/add-project-process', [App\Http\Controllers\system\project\ProjectController::class, 'addProjectProcess']);// Routes for Add Project Process
    Route::post('/edit-project-form-ajax', [App\Http\Controllers\system\project\ProjectController::class, 'editProjectFormAjax']);// Routes for Update Project Ajax Page
    Route::post('/update-project-process', [App\Http\Controllers\system\project\ProjectController::class, 'updateProjectProcess']);// Routes for Update Project Process
    Route::post('/delete-project-process', [App\Http\Controllers\system\project\ProjectController::class, 'deleteProjectProcess']);// Routes for Delete Project Process
    Route::post('/get-project-member-list', [App\Http\Controllers\system\project\ProjectController::class, 'getProjectMemberList']);//Routes for Project Management Page
    Route::get('/project/assign-task/{project_task_id}', [App\Http\Controllers\system\project\ProjectController::class, 'assignTask']);//Routes for Assign Task Page
    Route::post('/project/assign-user-form-ajax', [App\Http\Controllers\system\project\ProjectController::class, 'assignUserFormAjax']);//Routes for Assign User Form Page
    Route::post('/project/update-task-user-process', [App\Http\Controllers\system\project\ProjectController::class, 'updateTaskUserProcess']);// Routes for Add Project Process


    //****Task Management Rotes Here****//
    //Route::get('/my_project/task', [App\Http\Controllers\system\project\MyProjectController::class, 'task']);
    //****Assign User Management Rotes Here****//
    // Route::get('/my_project/assign_user', [App\Http\Controllers\system\project\MyProjectController::class, 'assignUser']);//Routes for Assign User Page
    // Route::get('/my_project/assign_user_view/{par1}', [App\Http\Controllers\system\project\MyProjectController::class, 'assignUserView']);
    // Route::post('/add-project-user-form-ajax', [App\Http\Controllers\system\project\MyProjectController::class, 'addProjectUserFormAjax']);
    // Route::post('/add-project-user-process', [App\Http\Controllers\system\project\MyProjectController::class, 'addProjectUserProcess']);
    // Route::post('/delete-project-user-process', [App\Http\Controllers\system\project\MyProjectController::class, 'deleteProjectUserProcess']);

    Route::get('/manage/task', [App\Http\Controllers\system\task\TaskController::class, 'index']);
    Route::post('/edit-task-form-ajax', [App\Http\Controllers\system\task\TaskController::class, 'editTaskFormAjax']);
    Route::post('/update-task-process', [App\Http\Controllers\system\task\TaskController::class, 'updateTaskProcess']);

    //****Leader Management Routes Here****//
    Route::get('/manage/leader', [App\Http\Controllers\system\leader\LeaderConroller::class, 'index']);//Routes for Leader Page
    Route::post('/add-leader-form-ajax', [App\Http\Controllers\system\leader\LeaderConroller::class, 'addLeaderFormAjax']);//Routes for Leader Add Page
    Route::post('/add-leader-process', [App\Http\Controllers\system\leader\LeaderConroller::class, 'addLeaderProcess']);//Routes for Leader Add 
    Route::post('/update-leader-form-ajax', [App\Http\Controllers\system\leader\LeaderConroller::class, 'updateLeaderFormAjax']);//Routes for Leader Update Page
    Route::post('/update-leader-process', [App\Http\Controllers\system\leader\LeaderConroller::class, 'updateLeaderProcess']);//Routes for Leader Update 
    Route::post('/delete-leader-process', [App\Http\Controllers\system\leader\LeaderConroller::class, 'deleteLeaderProcess']);

    //****Role Management Rotes Here****//
    Route::get('/manage/role', [App\Http\Controllers\system\role\RoleController::class, 'index']);//Routes for Role Management Page
    Route::post('/view-role-form-ajax', [App\Http\Controllers\system\role\RoleController::class, 'viewRoleFormAjax']);
    
});
