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
            <a type="button" class="btn btn-success" onclick="leader_add()">Add New</a>
        </div>
    </div>
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Leaders List
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Leader Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php $x = 0; ?>
                    @foreach ($leaders as $leader)
                    <?php $x++;?>
                    <tr data-row="{{ $leader->leader_id}}">
                        <td>{{ $x }}</td>
                        <td>{{ $leader->first_name.' '.$leader->last_name }}</td>
                        <td>
                            <?php if($leader->status=="0"){ 
                                echo "<span class='badge badge-success'>Active</span>";
                            }else{
                                echo "<span class='badge badge-danger'>Deactive</span>";
                            }?>
                        </td>
                        <td>
                            <a onclick="leader_update('{{$leader->leader_id}}')"><img src="{{ asset('system/images/png/edit.png') }}" width="25px"></a>&nbsp;&nbsp;
                            <a onclick="leader_delete('{{$leader->leader_id}}')"><img src="{{ asset('system/images/png/delete.png') }}" width="25px"></a>&nbsp;&nbsp;

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
function leader_add(){
    $.ajax({
        type:'POST',
        url: "{{URL::to('add-leader-form-ajax')}}",
        data: {"_token": "{{ csrf_token() }}"},
        success :function(content){
            load_modal('Add Leader',content.element,'60%');
        },
        error:function(){
            alert("Error!");
        }
    });
  }

  function leader_update(leader_id){
    $.ajax({
        type:'POST',
        url: "{{URL::to('update-leader-form-ajax')}}",
        data: {"_token": "{{ csrf_token() }}",leader_id:leader_id},
        success :function(content){
            load_modal('Update Leader',content.element,'60%');
        },
        error:function(){
            alert("Error!");
        }
    });
  }


  function leader_delete(leader_id){
    if(confirm("Are you sure do you want to delete this record?")){
        $.ajax({
            type:'POST',
            url: "{{URL::to('delete-leader-process')}}",
            data: {"_token": "{{ csrf_token() }}",leader_id:leader_id},
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
                