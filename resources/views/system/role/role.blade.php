@extends('system.layout.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">{{ $page_title }}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{URL::to('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item active">{{ $page_title }}</li>
    </ol>

    
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Roles Projects List
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Project Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Total Hour(s)</th>
                        <th>Leader</th>
                        <th>Project Type</th>
                        <th>Project Status</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php $x = 0; ?>
                    @foreach ($role_projects as $role_project)
                    <?php $x++;?>
                    <tr data-row="{{ $role_project->project_id}}">
                        <td>{{ $x }}</td>
                        <td>
                            <div class="project-title" style="font-weight: bold;color: #27292c;">{{ $role_project->project_name }}</div>
                            <div class="project-description" style="color: #fb0;">{{ $role_project->project_description }}</div>

                            <div>
                                <ul style="color:#28a745;">
                                <?php 
                                $project_tasks = $ProjectTasksModel->get_tasks_by_project_id($role_project->project_id);
                                foreach($project_tasks as $project_task){?>
                                    
                                        <li><?php echo $project_task->project_task;?></li>
                                    
                                <?php } ?>
                                </ul>
                            </div>
                        </td>
                        <td>{{ $role_project->start_date }}</td>
                        <td>{{ $role_project->end_date}}</td>
                        <td>{{ $role_project->total_hours}}</td>
                        <td>
                            <?php 
                            $user = $UsersModel->get_user_by_user_id($role_project->leader_id);
                            echo $user->first_name.' '.$user->last_name;
                            ?>
                        </td>
                        
                        <td>
                            <?php if($role_project->project_type=="REST_API_MD"){ 
                                echo "<span>Rest API Template - Multimedia Designer</span>";
                            }elseif($role_project->project_type=="REST_API_WD"){
                                echo "<span'>Rest API Template - Web Development</span>";
                            }elseif($role_project->project_type=="EMPTY_TEMPLATE"){
                                echo "<span'>Empty Template</span>";
                            }else{
                                 echo "<span'></span>";
                            }
                            ?>
                        </td>
                        <td>

                            <?php 
                            
                            if($role_project->project_status=="NEW"){ 
                                echo "<span class='badge badge-danger'>New</span>";
                            }elseif($role_project->project_status=="OPEN"){
                                echo "<span class='badge badge-primary'>OPEN</span>";
                            }elseif($role_project->project_status=="INPROGRESS"){
                                echo "<span class='badge badge-warning'>In Progress</span>";
                            }elseif($role_project->project_status=="COMPLETED"){
                                echo "<span class='badge badge-success'>Completed</span>";
                            }?>
                            <?php if($role_project->end_date < date("Y-m-d")){?>
                            <span class="blink" style="color:red;text-transform: uppercase;font-weight: bold;">Overdue! </span>
                            <?php } ?>
                        </td>
                        <td>
                            <?php if($role_project->status=="0"){ 
                                echo "<span class='badge badge-success'>Active</span>";
                            }else{
                                echo "<span class='badge badge-danger'>Deactive</span>";
                            }?>
                        </td>
                        <td>
                            <a><img src="{{ asset('system/images/png/task.png') }}" width="25px" onclick="role_view('{{ $role_project->project_id}}')"></a>&nbsp;&nbsp;

                        </td>
                    </tr>
                    @endforeach

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
//Load Project Role View With Model
function role_view(project_id){
    $.ajax({
        type:'POST',
        url: "{{URL::to('view-role-form-ajax')}}",
        data: {"_token": "{{ csrf_token() }}",project_id:project_id},
        success :function(content){
            load_modal('View Role',content.element,'40%');
        },
        error:function(){
            alert("Error!");
        }
    });
}


</script>


@endpush

@endsection
                