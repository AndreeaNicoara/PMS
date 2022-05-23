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
    return view('system.auth.login');//Landing page routes to login (view)  page
});

Route::post('/login-authentication', [App\Http\Controllers\system\auth\AuthController::class, 'loginAuthentication']);
Route::post('/login-form-ajax', [App\Http\Controllers\system\auth\AuthController::class, 'loginFormAjax']);
Route::get('/logout', [App\Http\Controllers\system\auth\AuthController::class, 'logout']);

Route::get('/signup', [App\Http\Controllers\system\auth\AuthController::class, 'signup']);
Route::post('/signup-process', [App\Http\Controllers\system\auth\AuthController::class, 'signupProcess']);

Route::group(['middleware' => 'web'], function () {
    Auth::routes();
    
    Route::get('/dashboard', [App\Http\Controllers\system\main\DashboardController::class, 'index']);

    //****User Management Routes****//
    Route::get('/manage/user', [App\Http\Controllers\system\user\UserController::class, 'index']);
    Route::post('/add-user-form-ajax', [App\Http\Controllers\system\user\UserController::class, 'addUserFormAjax']);
    Route::post('/add-user-process', [App\Http\Controllers\system\user\UserController::class, 'addUserProcess']);
    Route::post('/edit-user-form-ajax', [App\Http\Controllers\system\user\UserController::class, 'editUserFormAjax']);
    Route::post('/update-user-process', [App\Http\Controllers\system\user\UserController::class, 'updateUserProcess']);
    Route::post('/delete-user-process', [App\Http\Controllers\system\user\UserController::class, 'deleteUserProcess']);



    //****Project Management Routes****//
    Route::get('/manage/project', [App\Http\Controllers\system\project\ProjectController::class, 'index']);
    Route::post('/add-project-form-ajax', [App\Http\Controllers\system\project\ProjectController::class, 'addProjectFormAjax']);
    Route::post('/add-project-process', [App\Http\Controllers\system\project\ProjectController::class, 'addProjectProcess']);
    Route::post('/edit-project-form-ajax', [App\Http\Controllers\system\project\ProjectController::class, 'editProjectFormAjax']);
    Route::post('/update-project-process', [App\Http\Controllers\system\project\ProjectController::class, 'updateProjectProcess']);
    Route::post('/delete-project-process', [App\Http\Controllers\system\project\ProjectController::class, 'deleteProjectProcess']);
    Route::post('/get-project-member-list', [App\Http\Controllers\system\project\ProjectController::class, 'getProjectMemberList']);
    Route::get('/project/assign-task/{project_task_id}', [App\Http\Controllers\system\project\ProjectController::class, 'assignTask']);
    Route::post('/project/assign-user-form-ajax', [App\Http\Controllers\system\project\ProjectController::class, 'assignUserFormAjax']);
    Route::post('/project/update-task-user-process', [App\Http\Controllers\system\project\ProjectController::class, 'updateTaskUserProcess']);

    Route::get('/manage/task', [App\Http\Controllers\system\task\TaskController::class, 'index']);
    Route::post('/edit-task-form-ajax', [App\Http\Controllers\system\task\TaskController::class, 'editTaskFormAjax']);
    Route::post('/update-task-process', [App\Http\Controllers\system\task\TaskController::class, 'updateTaskProcess']);

    //****Leader Management Routes****//
    Route::get('/manage/leader', [App\Http\Controllers\system\leader\LeaderConroller::class, 'index']);
    Route::post('/add-leader-form-ajax', [App\Http\Controllers\system\leader\LeaderConroller::class, 'addLeaderFormAjax']);
    Route::post('/add-leader-process', [App\Http\Controllers\system\leader\LeaderConroller::class, 'addLeaderProcess']);
    Route::post('/update-leader-form-ajax', [App\Http\Controllers\system\leader\LeaderConroller::class, 'updateLeaderFormAjax']);
    Route::post('/update-leader-process', [App\Http\Controllers\system\leader\LeaderConroller::class, 'updateLeaderProcess']);
    Route::post('/delete-leader-process', [App\Http\Controllers\system\leader\LeaderConroller::class, 'deleteLeaderProcess']);

    //****Role Management Routes****//
    Route::get('/manage/role', [App\Http\Controllers\system\role\RoleController::class, 'index']);
    Route::post('/view-role-form-ajax', [App\Http\Controllers\system\role\RoleController::class, 'viewRoleFormAjax']);
    
});
