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
            <a type="button" class="btn btn-success" onclick="user_add()">Add New</a>
        </div>
    </div>
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Users List
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>User Type</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php $x = 0; ?>
                    @foreach ($users as $user)
                    <?php $x++;?>
                    <tr data-row="{{ $user->user_id}}">
                        <td>{{ $x }}</td>
                        <td>{{ $user->first_name }}</td>
                        <td>{{ $user->last_name }}</td>
                        <td>{{ $user->user_type}}</td>
                        <td>
                            <?php if($user->status=="0"){ 
                                echo "<span class='badge badge-success'>Active</span>";
                            }else{
                                echo "<span class='badge badge-danger'>Deactive</span>";
                            }?>
                        </td>
                        <td>
                            <a><img src="{{ asset('system/images/png/edit.png') }}" width="25px" onclick="user_edit('{{ $user->user_id}}')"></a>&nbsp;&nbsp;
                            <a><img src="{{ asset('system/images/png/delete.png') }}" width="25px" onclick="user_delete('{{ $user->user_id}}')"></a>

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

function user_add(){
    $.ajax({
        type:'POST',
        url: "{{URL::to('add-user-form-ajax')}}",
        data: {"_token": "{{ csrf_token() }}"},
        success :function(content){
            load_modal('Add User',content.element,'60%');
        },
        error:function(){
            alert("Error!");
        }
    });
  }

function user_edit(user_id){
    $.ajax({
        type:'POST',
        url: "{{URL::to('edit-user-form-ajax')}}",
        data: {"_token": "{{ csrf_token() }}",user_id:user_id},
        success :function(content){
            load_modal('Edit User',content.element,'60%');
        },
        error:function(){
            alert("Error!");
        }
    });
}

function user_delete(user_id){
    if(confirm("Are you sure you want to delete this record?")){
        $.ajax({
            type:'POST',
            url: "{{URL::to('delete-user-process')}}",
            data: {"_token": "{{ csrf_token() }}",user_id:user_id},
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
                