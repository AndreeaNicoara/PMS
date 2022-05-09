<form  method="POST" id="formUpdateLeader" class="lcs-form">
    <div class="card-body">
        

        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="inputUserId">User <span class="required">*</span></label>
                    <input type="hidden" class="form-control" id="inputLeaderId" name="leader_id" value="{{$leader->leader_id}}">
                    <select class="form-control" id="inputUserId" name="user_id">
                        <option value="">Select User</option>
                        <?php foreach ($users as $key => $user) { ?>
                            <option value="<?php echo $user->user_id;?>" <?php if($leader->user_id ==$user->user_id){echo "selected";}?>><?php echo $user->first_name.' '.$user->last_name;?></option>
                        <?php } ?>
                    </select>
                    <span class="text-danger input-error user_id-error"></span>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="inputStatus">Status <span class="required">*</span></label>
                    <select class="form-control" id="inputStatus" name="status">
                        <option value="">Select Status</option>
                        <option value="0" <?php if($leader->status=="0"){echo "selected";}?>>Active</option>
                        <option value="1" <?php if($leader->status=="1"){echo "selected";}?>>Deactive</option>
                    </select>
                    <span class="text-danger input-error status-error"></span>
                </div>
            </div>
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
    

    var form = $('#formUpdateLeader'); 

    form.on( 'submit', function(e) {
        e.preventDefault();

        $('.input-error').html("");

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url     : "{{URL::to('update-leader-process')}}",
            type    : form.attr('method'),
            data    : form.serialize(),
            dataType: 'json',
            success : function ( data ){
                if(data.status == true){
                    $('.message-box').html('<div class="alert alert-success">'+ data.message +'</div>');
                    setTimeout(function(){
                        window.location.href = "{{URL::to('manage/leader/')}}";
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


                