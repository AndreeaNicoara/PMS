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
            My Projects List
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
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php $x = 0; ?>
                    @foreach ($my_projects as $my_project)
                    <?php $x++;?>
                    <tr data-row="{{ $my_project->project_id}}">
                        <td>{{ $x }}</td>
                        <td>{{ $my_project->project_name }}</td>
                        <td>{{ $my_project->start_date }}</td>
                        <td>{{ $my_project->end_date}}</td>
                        <td>{{ $my_project->total_hours}}</td>
                        <td>
                            <?php 
                            $user = $UsersModel->get_user_by_user_id($my_project->project_manager_id);
                            echo $user->first_name.' '.$user->last_name;
                            ?>
                        </td>
                        <td>
                            <?php if($my_project->project_type=="REST_API_MD"){ 
                                echo "<span>Rest API Template - Multimedia Designer</span>";
                            }elseif($my_project->project_type=="REST_API_WD"){
                                echo "<span'>Rest API Template - Web Development</span>";
                            }elseif($my_project->project_type=="EMPTY_TEMPLATE"){
                                echo "<span'>Empty Template</span>";
                            }else{
                                 echo "<span'></span>";
                            }
                            ?>
                        </td>
                        <td>
                            <?php if($my_project->status=="0"){ 
                                echo "<span class='badge badge-success'>Active</span>";
                            }else{
                                echo "<span class='badge badge-danger'>Deactive</span>";
                            }?>
                        </td>
                        <td>
                            <a><img src="{{ asset('system/images/png/task.png') }}" width="25px" onclick="task_add('{{ $my_project->project_id}}')"></a>&nbsp;&nbsp;
                            <!-- <a href="{{URL::to('my_project/assign_user_view/'.$my_project->project_id)}}"><img src="{{ asset('system/images/png/key.png') }}" width="25px"></a>&nbsp;&nbsp; -->

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
function project_add(){
    $.ajax({
        type:'POST',
        url: "{{URL::to('add-project-form-ajax')}}",
        data: {"_token": "{{ csrf_token() }}"},
        success :function(content){
            load_modal('Add Project',content.element,'60%');
        },
        error:function(){
            alert("Error!");
        }
    });
  }


  function project_edit(project_id){
    $.ajax({
        type:'POST',
        url: "{{URL::to('edit-project-form-ajax')}}",
        data: {"_token": "{{ csrf_token() }}",project_id:project_id},
        success :function(content){
            load_modal('Edit Project',content.element,'60%');
        },
        error:function(){
            alert("Error!");
        }
    });
  }

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
                