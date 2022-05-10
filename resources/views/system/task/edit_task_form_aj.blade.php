
<form  method="POST" id="formUpdateTask" class="lcs-form">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="inputTaskStatus">Task Status <span class="required">*</span></label>
                    <input type="hidden" class="form-control" id="inputProjectTaskId" name="project_task_id" value="{{$task->project_task_id}}">
                    
                    <select class="form-control" id="inputTaskStatus" name="task_status">
                        <option value="">Select Status</option>
                        <option value="NEW" <?php if($task->task_status == "NEW"){ echo "selected";}?>>New</option>
                        <option value="OPENED" <?php if($task->task_status == "OPENED"){ echo "selected";}?>>Open</option>
                        <option value="INPROGRESS" <?php if($task->task_status == "INPROGRESS"){ echo "selected";}?>>In Progress</option>
                        <option value="COMPLETED" <?php if($task->task_status == "COMPLETED"){ echo "selected";}?>>Completed</option>
                    </select>
                    <span class="text-danger input-error status-error"></span>
                </div>
            </div>
            <div class="col-lg-8"></div>
        </div>

        

    
        <div class="row">
            <div class="col-lg-12">
                <div class="message-box" style="text-align:center;">
                    
                </div>
            </div>
        </div>

        

        
    </div>

    <div class="card-footer">
        <div class="row">
            <div class="col-lg-12">
                <div class="pull-right">
                    <button type="submit" class="btn btn-success form-submit" id="formUpdateProjectSubmit">Submit</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">

$(document).ready(function(){
    

    var form = $('#formUpdateTask'); 

    form.on( 'submit', function(e) {
        e.preventDefault();

        $('.input-error').html("");

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url     : "{{URL::to('update-task-process')}}",
            type    : form.attr('method'),
            data    : form.serialize(),
            dataType: 'json',
            success : function ( data ){
                if(data.status == true){
                    $('.message-box').html('<div class="alert alert-success">'+ data.message +'</div>');
                    setTimeout(function(){
                        window.location.href = "{{URL::to('manage/task')}}";
                    }, 1000);
                }else{
                    $('.message-box').html('<div class="alert alert-danger">'+ data.message +'</div>');
                }
            },
            error: function( data ){
                var errors = data.responseJSON;
                $.each(data.responseJSON.errors, function (key, value) {
                    $('.'+key+'-error').html(value);
                });
            }
        });
    });
});
</script>


                