<form  method="POST" id="formAddUser" class="lcs-form">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="inputFirstName">First Name <span class="required">*</span></label>
                    <input type="text" class="form-control" id="inputFirstName" name="first_name">
                    <span class="text-danger input-error first_name-error"></span>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="inputLastName">Last Name <span class="required">*</span></label>
                    <input type="text" class="form-control" id="inputLastName" name="last_name">
                    <span class="text-danger input-error last_name-error"></span>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="inputUserType">User Type <span class="required">*</span></label>
                    <select class="form-control" id="inputUserType" name="user_type">
                        <option value="">Select User Type</option>
                        <option value="USER">User</option>
                        <option value="ADMIN">Admin</option>
                    </select>
                    <span class="text-danger input-error user_type-error"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="inputUsername">Username <span class="required">*</span></label>
                    <input type="text" class="form-control" id="inputUsername" name="username">
                    <span class="text-danger input-error username-error"></span>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="inputPassword">Password <span class="required">*</span></label>
                    <input type="text" class="form-control" id="inputPassword" name="password">
                    <span class="text-danger input-error password-error"></span>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="inputStatus">Status <span class="required">*</span></label>
                    <select class="form-control" id="inputStatus" name="status">
                        <option value="">Select Status</option>
                        <option value="0">Active</option>
                        <option value="1">Inactive</option>
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
    
    //Add user form submit
    var form = $('#formAddUser'); //Get login form variable by ID

    form.on( 'submit', function(e) {
        e.preventDefault();//Stops the default action of a selected element from happening

        $('.input-error').html("");//Clear all the input error messages 

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')//Pass CSRF token on header using name attribute
            }
        });
 
        $.ajax({
            url     : "{{URL::to('add-user-process')}}",
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
                    $('.message-box').html('<div class="alert alert-danger">'+ data.message +'</div>');//Display main form error
                }
            },
            error: function( data ){
                var errors = data.responseJSON;
                //Display response message according to relevant input error message
                $.each(data.responseJSON.errors, function (key, value) {
                    $('.'+key+'-error').html(value);
                });
            }
        });
    });
});
</script>


                