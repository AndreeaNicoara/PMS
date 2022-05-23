@extends('system.layout.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">{{ $page_title }}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{URL::to('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{URL::to('/manage/project')}}">Projects</a></li>
        <li class="breadcrumb-item active">{{ $page_title }}</li>
    </ol>
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Projects List
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        
                        <th>Task</th>
                        <th>Task User</th>
                        <th>Project Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                
                <tbody>
                   
                    <tr data-row="{{ $project_task->project_id}}">
                        
                        <td>
                            {{ $project_task->project_task }}
                        </td>
                        <td>
                            <?php 
                            
                            if($project_task->user_id!=""){
                                $user = $UsersModel->get_user_by_user_id($project_task->user_id);
                                echo $user->first_name.' '.$user->last_name;
                            }
                            ?>
                        </td>
                        <td>

                            <?php 
                            
                            if($project_task->task_status=="NEW"){ 
                                echo "<span class='badge badge-danger'>New</span>";
                            }elseif($project_task->task_status=="Open"){
                                echo "<span class='badge badge-primary'>Open</span>";
                            }elseif($project_task->task_status=="INPROGRESS"){
                                echo "<span class='badge badge-warning'>In Progress</span>";
                            }elseif($project_task->task_status=="COMPLETED"){
                                echo "<span class='badge badge-success'>Completed</span>";
                            }?>
                        </td>
                        
                        <td>
                            <a onclick="assign_user('{{$project_task_id}}')"><img src="{{ asset('system/images/png/task.png') }}" width="25px"></a>&nbsp;&nbsp;

                        </td>
                    </tr>

                    <tr>
                        <td colspan="6">
                            <div class="table-message-box" style="text-align:center;">
                            
                            </div>
                        </td>
                    </tr>
                </tbody>

                
            </table>
        </div>
    </div>
</div>

@push('scripting')
<script>
//Load assign user with model
function assign_user(project_task_id){
    $.ajax({
        type:'POST',
        url: "{{URL::to('project/assign-user-form-ajax')}}",
        data: {"_token": "{{ csrf_token() }}",project_task_id:project_task_id},
        success :function(content){
            load_modal('Add Task User',content.element,'40%');
        },
        error:function(){
            alert("Error!");
        }
    });
}


</script>


@endpush

@endsection
                