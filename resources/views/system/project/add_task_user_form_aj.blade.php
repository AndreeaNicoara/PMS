<form  method="POST" id="formAddTaskUser" class="lcs-form">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="inputUserId">User<span class="required">*</span></label>
                    <input type="hidden" id="inputProjectTaskId" name="project_task_id" value="<?php echo $project_task_id;?>">
                    <select class="form-control wizard-required" id="inputUserId" name="user_id" placeholder="">
                        <option value=""></option>
                        <?php foreach ($task_users as $key => $task_user) { ?>
                            
                            <option value="<?php echo $task_user->user_id;?>"><?php echo $task_user->first_name.' '.$task_user->last_name;;?></option>
                            
                        <?php } ?>
                    </select>
                    <span class="text-danger input-error user_id-error wizard-form-error"></span>
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
    
    // Update User Form Submit
    var form = $('#formAddTaskUser'); //Get Login Form to the Variable by Id

    form.on( 'submit', function(e) {
        e.preventDefault();//Stops the Default Action of a Selected Element from Happening by a User

        $('.input-error').html("");// Clear All the Input Error Message 

        var project_task_id = $("#inputProjectTaskId").val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')//Pass crf token on header using name attribute
            }
        });
        //AJax Code Goes Here
        $.ajax({
            url     : "{{URL::to('project/update-task-user-process')}}",// Url To Task User Add Process
            type    : form.attr('method'),
            data    : form.serialize(),//Pass Data Here
            dataType: 'json',
            success : function ( data ){
                if(data.status == true){
                    $('.message-box').html('<div class="alert alert-success">'+ data.message +'</div>');
                    setTimeout(function(){
                        window.location.href = "{{URL::to('project/assign-task/')}}/"+project_task_id;
                    }, 1000);
                }else{
                    $('.message-box').html('<div class="alert alert-danger">'+ data.message +'</div>');// Dispaly Main Form Error
                }
            },
            error: function( data ){
                var errors = data.responseJSON;
                //Display Response Meesage According to Relevant Input Error Message
                $.each(data.responseJSON.errors, function (key, value) {
                    $('.'+key+'-error').html(value);
                });
            }
        });
    });
});
</script>


                