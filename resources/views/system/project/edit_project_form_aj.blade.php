
<form  method="POST" id="formUpdateProject" class="lcs-form">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="inputProjectName">Project Name <span class="required">*</span></label>
                    <input type="hidden" class="form-control" id="inputProjectId" name="project_id" value="{{$project->project_id}}">
                    <input type="text" class="form-control" id="inputProjectName" name="project_name" value="{{$project->project_name}}">
                    <span class="text-danger input-error project_name-error"></span>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="inputStartDate">Start Date <span class="required">*</span></label>
                    <input type="date" class="form-control" id="inputStartDate" name="start_date" value="{{$project->start_date}}">
                    <span class="text-danger input-error start_date-error"></span>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="inputEndDate">End Date <span class="required">*</span></label>
                    <input type="date" class="form-control" id="inputEndDate" name="end_date" value="{{$project->end_date}}">
                    <span class="text-danger input-error end_date-error"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="inputProjectManagerId">Project Manager <span class="required">*</span></label>
                    <select class="form-control" id="inputProjectManagerId" name="project_manager_id">
                        <option value="">Select Project Manager</option>
                        <?php foreach ($project_managers as $key => $project_manager) { ?>
                            <option value="<?php echo $project_manager->user_id;?>" <?php if($project_manager->user_id == $project->project_manager_id){ echo "selected"; } ?>><?php echo $project_manager->first_name.' '.$project_manager->last_name;;?></option>
                        <?php } ?>
                    </select>
                    <span class="text-danger input-error status-error"></span>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    <label for="inputProjectType">Project Type <span class="required">*</span></label>
                    <select class="form-control" id="inputProjectType" name="project_type">
                        <option value="">Select Project Type</option>
                        <option value="REST_API_MD" <?php if($project->project_type=="REST_API_MD"){ echo "selected";} ?>>Rest API Template - Multimedia Designer</option>
                        <option value="REST_API_WD" <?php if($project->project_type=="REST_API_WD"){ echo "selected";} ?>>Rest API Template - Web Development</option>
                        <option value="EMPTY_TEMPLATE" <?php if($project->project_type=="EMPTY_TEMPLATE"){ echo "selected";} ?>>Empty Template</option>
                    </select>
                    <span class="text-danger input-error project_type-error"></span>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="form-group">
                    <label for="inputTotalHours">Total Hour(s) <span class="required">*</span></label>
                    <input type="text" class="form-control" id="inputTotalHours" name="total_hours" value="<?php echo $project->total_hours;?>">
                    <span class="text-danger input-error total_hours-error"></span>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <label for="inputStatus">Status <span class="required">*</span></label>
                    <select class="form-control" id="inputStatus" name="status">
                        <option value="">Select Status</option>
                        <option value="0" <?php if($project->status=="0"){ echo "selected";} ?>>Active</option>
                        <option value="1" <?php if($project->status=="1"){ echo "selected";} ?>>Deactive</option>
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
                    <button type="submit" class="btn btn-success form-submit" id="formAddProjectSubmit">Submit</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">

$(document).ready(function(){
    

    var form = $('#formUpdateProject'); 

    form.on( 'submit', function(e) {
        e.preventDefault();

        $('.input-error').html("");

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url     : "{{URL::to('update-project-process')}}",
            type    : form.attr('method'),
            data    : form.serialize(),
            dataType: 'json',
            success : function ( data ){
                if(data.status == true){
                    $('.message-box').html('<div class="alert alert-success">'+ data.message +'</div>');
                    setTimeout(function(){
                        window.location.href = "{{URL::to('manage/project')}}";
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


                