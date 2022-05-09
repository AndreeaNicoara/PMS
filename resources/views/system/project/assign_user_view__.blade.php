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
            <a type="button" class="btn btn-success" onclick="assign_user_add('{{$project->project_id}}')">Add New</a>
        </div>
    </div>
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            My Projects Assign List - {{$project->project_name}}
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Project Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php $x = 0; ?>
                    @foreach ($not_assign_project_users as $not_assign_project_user)
                    <?php $x++;?>
                    <tr data-row="{{ $not_assign_project_user->project_users_id}}">
                        <td>{{ $x }}</td>
                        <td>{{ $not_assign_project_user->first_name.' '.$not_assign_project_user->last_name }}</td>
                        <td>{{ $not_assign_project_user->project_name }}</td>
                        <td>
                            <a onclick="assign_user_delete('{{$not_assign_project_user->project_users_id}}')"><img src="{{ asset('system/images/png/delete.png') }}" width="25px"></a>&nbsp;&nbsp;

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
function assign_user_add(project_id){
    $.ajax({
        type:'POST',
        url: "{{URL::to('add-project-user-form-ajax')}}",
        data: {"_token": "{{ csrf_token() }}",project_id:project_id},
        success :function(content){
            load_modal('Add Project User',content.element,'60%');
        },
        error:function(){
            alert("Error!");
        }
    });
  }


  function assign_user_delete(project_users_id){
    if(confirm("Are you sure do you want to delete this record?")){
        $.ajax({
            type:'POST',
            url: "{{URL::to('delete-project-user-process')}}",
            data: {"_token": "{{ csrf_token() }}",project_users_id:project_users_id},
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
                