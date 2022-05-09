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
            <a type="button" class="btn btn-success" onclick="task_add()">Add New</a>
        </div>
    </div>
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            My Tasks List
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Task Name</th>
                        <th>Project</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php $x = 0; ?>
                    @foreach ($tasks as $task)
                    <?php $x++;?>
                    <tr data-row="{{ $task->task_id}}">
                        <td>{{ $x }}</td>
                        <td>{{ $task->task_name }}</td>
                        <td>{{ $task->project_name }}</td>
                        <td>{{ $task->start_date}}</td>
                        <td>{{ $task->end_date}}</td>
                        
                        <td>

                            <?php 
                            
                            if($task->status=="NEW"){ 
                                echo "<span class='badge badge-danger'>New</span>";
                            }elseif($task->status=="OPEN"){
                                echo "<span class='badge badge-primary'>OPEN</span>";
                            }elseif($task->status=="INPROGRESS"){
                                echo "<span class='badge badge-warning'>In Progress</span>";
                            }elseif($task->status=="COMPLETED"){
                                echo "<span class='badge badge-success'>Completed</span>";
                            }?>
                        </td>
                        <td>
                            <a><img src="{{ asset('system/images/png/edit.png') }}" width="25px" onclick="task_edit('{{ $task->task_id}}')"></a>&nbsp;&nbsp;
                            <a><img src="{{ asset('system/images/png/delete.png') }}" width="25px" onclick="task_delete('{{ $task->task_id}}')"></a>

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
function task_add(){
    $.ajax({
        type:'POST',
        url: "{{URL::to('add-task-form-ajax')}}",
        data: {"_token": "{{ csrf_token() }}"},
        success :function(content){
            load_modal('Add Task',content.element,'60%');
        },
        error:function(){
            alert("Error!");
        }
    });
  }


  function task_edit(task_id){
    $.ajax({
        type:'POST',
        url: "{{URL::to('edit-task-form-ajax')}}",
        data: {"_token": "{{ csrf_token() }}",task_id:task_id},
        success :function(content){
            load_modal('Edit Task',content.element,'60%');
        },
        error:function(){
            alert("Error!");
        }
    });
  }

  function task_delete(project_id){
    if(confirm("Are you sure do you want to delete this record?")){
        $.ajax({
            type:'POST',
            url: "{{URL::to('delete-task-process')}}",
            data: {"_token": "{{ csrf_token() }}",task_id:task_id},
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
                