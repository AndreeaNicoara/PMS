
<form  method="POST" id="formUpdateUser" class="lcs-form">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="inputFirstName">First Name <span class="required">*</span></label>
                    <input type="hidden" class="form-control" id="inputUserId" name="user_id" value="{{$user->user_id}}">
                    <input type="text" class="form-control" id="inputFirstName" name="first_name" value="{{$user->first_name}}">
                    <span class="text-danger input-error first_name-error"></span>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="inputLastName">Last Name <span class="required">*</span></label>
                    <input type="text" class="form-control" id="inputLastName" name="last_name" value="{{$user->last_name}}">
                    <span class="text-danger input-error last_name-error"></span>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="inputUserType">User Type <span class="required">*</span></label>
                    <select class="form-control" id="inputUserType" name="user_type">
                        <option value="">Select User Type</option>
                        <option value="USER" <?php if($user->user_type="USER"){ echo "selected"; } ?>>User</option>
                        <option value="ADMIN" <?php if($user->user_type="ADMIN"){ echo "selected"; } ?>>Admin</option>
                    </select>
                    <span class="text-danger input-error user_type-error"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="inputUsername">Username <span class="required">*</span></label>
                    <input type="text" class="form-control" id="inputUsername" name="username" value="{{$user->username}}">
                    <span class="text-danger input-error username-error"></span>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="inputPassword">Password <span class="required">*</span></label>
                    <input type="text" class="form-control" id="inputPassword" name="password" value="{{$user->confirmation_code}}">
                    <span class="text-danger input-error password-error"></span>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="inputStatus">Status <span class="required">*</span></label>
                    <select class="form-control" id="inputStatus" name="status">
                        <option value="">Select Status</option>
                        <option value="0" <?php if($user->status="0"){ echo "selected"; } ?>>Active</option>
                        <option value="1" <?php if($user->status="1"){ echo "selected"; } ?>>Inactive</option>
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
    

    var form = $('#formUpdateUser'); 

    form.on( 'submit', function(e) {
        e.preventDefault();

        $('.input-error').html("");

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url     : "{{URL::to('update-user-process')}}",
            type    : form.attr('method'),
            data    : form.serialize(),
            dataType: 'json',
            success : function ( data ){
                if(data.status == true){
                    $('.message-box').html('<div class="alert alert-success">'+ data.message +'</div>');
                    setTimeout(function(){
                        window.location.href = "{{URL::to('manage/user')}}";
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


                