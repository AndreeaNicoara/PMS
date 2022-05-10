@extends('system.layout.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">{{ $page_title }}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{URL::to('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item active">{{ $page_title }}</li>
    </ol>

    <div class="card mb-4">
        <div class="card-body">
            <a type="button" class="btn btn-success" onclick="project_add()">Add New</a>
        </div>
    </div>
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Projects List
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
                        <th>Project Manager</th>
                        <th>Project Type</th>
                        <th>Project Status</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php $x = 0; ?>
                    @foreach ($leader_projects as $leader_project)
                    <?php $x++;?>
                    <tr data-row="{{ $leader_project->project_id}}">
                        <td>{{ $x }}</td>
                        <td>
                            <div class="project-title" style="font-weight: bold;color: #27292c;">{{ $leader_project->project_name }}</div>
                            <div class="project-description" style="color: #fb0;">{{ $leader_project->project_description }}</div>

                            <div>
                                <ul style="color:#28a745;">
                                <?php 
                                $project_tasks = $ProjectTasksModel->get_tasks_by_project_id($leader_project->project_id);
                                foreach($project_tasks as $project_task){?>
                                    
                                        <li><?php echo $project_task->project_task;?></li>
                                    
                                <?php } ?>
                                </ul>
                            </div>
                        </td>
                        <td>{{ $leader_project->start_date }}</td>
                        <td>{{ $leader_project->end_date}}</td>
                        <td>{{ $leader_project->total_hours}}</td>
                        <td>
                            <?php 
                            $user = $UsersModel->get_user_by_user_id($leader_project->leader_id);
                            echo $user->first_name.' '.$user->last_name;
                            ?>
                        </td>
                        
                        <td>
                            <?php if($leader_project->project_type=="REST_API_MD"){ 
                                echo "<span>Rest API Template - Multimedia Designer</span>";
                            }elseif($leader_project->project_type=="REST_API_WD"){
                                echo "<span'>Rest API Template - Web Development</span>";
                            }elseif($leader_project->project_type=="EMPTY_TEMPLATE"){
                                echo "<span'>Empty Template</span>";
                            }else{
                                 echo "<span'></span>";
                            }
                            ?>
                        </td>
                        <td>

                            <?php 
                            
                            if($leader_project->project_status=="NEW"){ 
                                echo "<span class='badge badge-danger'>New</span>";
                            }elseif($task->project_status=="OPEN"){
                                echo "<span class='badge badge-primary'>OPEN</span>";
                            }elseif($task->project_status=="INPROGRESS"){
                                echo "<span class='badge badge-warning'>In Progress</span>";
                            }elseif($task->project_status=="COMPLETED"){
                                echo "<span class='badge badge-success'>Completed</span>";
                            }?>
                        </td>
                        <td>
                            <?php if($leader_project->status=="0"){ 
                                echo "<span class='badge badge-success'>Active</span>";
                            }else{
                                echo "<span class='badge badge-danger'>Deactive</span>";
                            }?>
                        </td>
                        <td>
                            <a><img src="{{ asset('system/images/png/edit.png') }}" width="25px" onclick="project_edit('{{ $leader_project->project_id}}')"></a>&nbsp;&nbsp;
                            <a><img src="{{ asset('system/images/png/delete.png') }}" width="25px" onclick="project_delete('{{ $leader_project->project_id}}')"></a>

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
//Load Project Add View With Model
function project_add(){
    $.ajax({
        type:'POST',
        url: "{{URL::to('add-project-form-ajax')}}",
        data: {"_token": "{{ csrf_token() }}"},
        success :function(content){
            load_modal('Add Project',content.element,'90%');
        },
        error:function(){
            alert("Error!");
        }
    });
}

//Load Project Edit View With Model
function project_edit(project_id){
    $.ajax({
        type:'POST',
        url: "{{URL::to('edit-project-form-ajax')}}",
        data: {"_token": "{{ csrf_token() }}",project_id:project_id},
        success :function(content){
            load_modal('Edit Project',content.element,'90%');
        },
        error:function(){
            alert("Error!");
        }
    });
}

//Delete Project With Ajax
function project_delete(project_id){
    if(confirm("Are you sure do you want to delete this record?")){
        $.ajax({
            type:'POST',
            url: "{{URL::to('delete-project-process')}}",
            data: {"_token": "{{ csrf_token() }}",project_id:project_id},
            dataType: 'json',
            success :function(data){
                if(data.status == true){
                    $('.table-message-box').html('<div class="alert alert-success">'+ data.message +'</div>');
                    setTimeout(function(){
                        window.location.reload();
                    }, 1000);
                }else{
                    $('.table-message-box').html('<div class="alert alert-danger">'+ data.message +'</div>');
                }
            },
            error:function(){
                alert("Error!");
            }
        });
    }
  }
</script>


@endpush

@endsection
                