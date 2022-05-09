<form  method="POST" id="formAddTask" class="lcs-form">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="inputProjectId">Project<span class="required">*</span></label>
                    <select class="form-control" id="inputProjectId" name="project_id">
                        <option value="">Select Project</option>
                        <?php foreach ($projects as $key => $project) { ?>
                            <option value="<?php echo $project->project_id;?>"><?php echo $project->project_name;?></option>
                        <?php } ?>
                    </select>
                    <span class="text-danger input-error project_id-error"></span>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="form-group">
                    <label for="inputTaskName">Task Name <span class="required">*</span></label>
                    <input type="text" class="form-control" id="inputTaskName" name="task_name">
                    <span class="text-danger input-error task_name-error"></span>
                </div>
            </div>
            
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="inputStartDate">Start Date <span class="required">*</span></label>
                    <input type="date" class="form-control" id="inputStartDate" name="start_date">
                    <span class="text-danger input-error start_date-error"></span>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="inputEndDate">End Date <span class="required">*</span></label>
                    <input type="date" class="form-control" id="inputEndDate" name="end_date">
                    <span class="text-danger input-error end_date-error"></span>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="inputStatus">Status <span class="required">*</span></label>
                    <select class="form-control" id="inputStatus" name="status">
                        <option value="">Select Status</option>
                        <option value="NEW">New</option>
                        <option value="OPEN">Open</option>
                        <option value="INPROGRESS">In Progress</option>
                        <option value="COMPLETED">Completed</option>
                    </select>
                    <span class="text-danger input-error status-error"></span>
                </div>
            </div>
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
                    <button type="submit" class="btn btn-success form-submit" id="formAddUserSubmit">Submit</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">

$(document).ready(function(){
    

    var form = $('#formAddTask'); 

    form.on( 'submit', function(e) {
        e.preventDefault();

        $('.input-error').html("");

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url     : "{{URL::to('add-task-process')}}",
            type    : form.attr('method'),
            data    : form.serialize(),
            dataType: 'json',
            success : function ( data ){
                if(data.status == true){
                    $('.message-box').html('<div class="alert alert-success">'+ data.message +'</div>');
                    setTimeout(function(){
                        window.location.href = "{{URL::to('manage/my_task')}}";
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


                