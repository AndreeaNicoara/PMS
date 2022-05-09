<form  method="POST" id="formAddProjectUser" class="lcs-form">
    <div class="card-body">
        

        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="inputProjectManagerId">Project Manager <span class="required">*</span></label>
                    <input type="hidden" id="inputProjectId" name="project_id" value="{{ $project_id }}">
                    <select class="form-control" id="inputProjectUserId" name="project_user_id">
                        <option value="">Select Project User</option>
                        <?php foreach ($project_users as $key => $project_user) { ?>
                            <option value="<?php echo $project_user->user_id;?>"><?php echo $project_user->first_name.' '.$project_user->last_name;;?></option>
                        <?php } ?>
                    </select>
                    <span class="text-danger input-error status-error"></span>
                </div>
            </div>
            <div class="col-lg-4"></div>
            <div class="col-lg-4"></div>
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
    

    var form = $('#formAddProjectUser'); 

    form.on( 'submit', function(e) {
        e.preventDefault();

        $('.input-error').html("");

        var project_id = $("#inputProjectId").val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url     : "{{URL::to('add-project-user-process')}}",
            type    : form.attr('method'),
            data    : form.serialize(),
            dataType: 'json',
            success : function ( data ){
                if(data.status == true){
                    $('.message-box').html('<div class="alert alert-success">'+ data.message +'</div>');
                    setTimeout(function(){
                        window.location.href = "{{URL::to('my_project/assign_user_view/'.$project_id)}}";
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


                