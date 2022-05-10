<form  method="POST" id="formAddProject" class="lcs-form">
    <div class="card-body">
        <section class="wizard-section">
            <div class="row no-gutters">
                
                <div class="col-lg-12 col-md-12">
                    <div class="form-wizard">
                        <form action="" method="post" role="form">
                            <div class="form-wizard-header">
                                <ul class="list-unstyled form-wizard-steps clearfix">
                                    <li class="active"><span>1</span></li>
                                    <li><span>2</span></li>
                                    <li><span>3</span></li>
                                </ul>
                            </div>

                            
                            <fieldset class="wizard-fieldset show">
                                <h3>Project Setup</h3>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="inputProjectType">Project Type <span class="required">*</span></label>
                                            <select class="form-control wizard-required" id="inputProjectType" name="project_type">
                                                <option value=""></option>
                                                <option value="REST_API_MD">Rest API Template - Multimedia Designer</option>
                                                <option value="REST_API_WD">Rest API Template - Web Development</option>
                                                <option value="EMPTY_TEMPLATE">Empty Template</option>
                                            </select>
                                            <span class="text-danger input-error project_type-error wizard-form-error"></span>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="inputProjectStatus">Project Status <span class="required">*</span></label>
                                            <select class="form-control" id="inputProjectStatus" name="project_status">
                                                <option value="">Select Status</option>
                                                <option value="NEW">New</option>
                                                <option value="OPENED">Opened</option>
                                                <option value="INPROGRESS">In Progress</option>
                                                <option value="COMPLETED">Completed</option>
                                            </select>
                                            <span class="text-danger input-error status-error"></span>
                                        </div>
                                    </div>
                                </div>

                            
                                <h5>Project</h5>
                                <hr/>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="inputProjectName">Project Name <span class="required">*</span></label>
                                            <input type="text" class="form-control wizard-required" id="inputProjectName" name="project_name">
                                            <span class="text-danger input-error project_name-error wizard-form-error"></span>
                                        </div>
                                    </div>

                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="inputProjectCode">Project Code <span class="required">*</span></label>
                                            <input type="text" class="form-control wizard-required" id="inputProjectCode" name="project_code">
                                            <span class="text-danger input-error project_code-error wizard-form-error"></span>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="inputProjectDescription">Project Description </label>
                                            <textarea class="form-control" id="inputProjectDescription" name="project_description" maxlength="200"></textarea>
                                            <span class="text-danger input-error project_description-error"></span>
                                        </div>
                                    </div>
                                </div>
                              
                            
                                <h5>Time Shedule</h5>
                                <hr/>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="inputStartDate">Start Date <span class="required">*</span></label>
                                            <input type="date" class="form-control wizard-required" id="inputStartDate" name="start_date" placeholder="">
                                            <span class="text-danger input-error start_date-error wizard-form-error"></span>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="inputEndDate">End Date <span class="required">*</span></label>
                                            <input type="date" class="form-control wizard-required" id="inputEndDate" name="end_date" placeholder="">
                                            <span class="text-danger input-error end_date-error wizard-form-error"></span>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="inputTotalHours">Total Hour(s) <span class="required">*</span></label>
                                            <input type="text" class="form-control wizard-required" id="inputTotalHours" name="total_hours">
                                            <span class="text-danger input-error total_hours-error wizard-form-error"></span>
                                        </div>
                                    </div>
                                </div>


                                <h5>Stakeholders</h5>
                                <hr/>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="inputStakeholders">Stakeholder/Partners </label>
                                            <input type="text" class="form-control" id="inputStakeholders" name="stakeholders" placeholder="">
                                            <span class="text-danger input-error stakeholders-error"></span>
                                        </div>
                                    </div>

                                    <div class="col-lg-4"></div>

                                    <div class="col-lg-4"></div>
                                </div>


                                <h5>Members</h5>
                                <hr/>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="inputProjectLeader">Project Leader <span class="required">*</span></label>
                                            <select class="form-control wizard-required" id="inputProjectLeader" name="project_leader" placeholder="">
                                                <option value=""></option>
                                                <?php foreach ($project_managers as $key => $project_manager) { ?>
                                                    <?php if($project_manager->user_id==$user_id){?>
                                                    <option value="<?php echo $project_manager->user_id;?>"><?php echo $project_manager->first_name.' '.$project_manager->last_name;;?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                            <span class="text-danger input-error project_leader-error wizard-form-error"></span>
                                        </div>
                                    </div>

                                    <div class="col-lg-4"></div>

                                    <div class="col-lg-4"></div>
                                </div>


                                <div class="row" >
                                    <div class="col-lg-4">
                                        <a class="add-more-member" href="#">Add Project Member</a>
                                    </div>
                                </div>

                                <div class="row project_members" style="display: none;">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="inputProjectMember">Project Members </label>
                                            <select class="form-control" id="inputProjectMembers" name="project_members[]" placeholder="">
                                                <option value=""></option>
                                                <?php foreach ($project_managers as $key => $project_manager) { ?>
                                                    <option value="<?php echo $project_manager->user_id;?>"><?php echo $project_manager->first_name.' '.$project_manager->last_name;;?></option>
                                                <?php } ?>
                                            </select>
                                            <span class="text-danger input-error project_leader-error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 control-btn">
                                    </div>
                                </div>

                                <div class="project_members_dynamic"></div>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group clearfix">
                                            <a href="javascript:;" class="form-wizard-previous-btn float-left">Previous</a>
                                            <a href="javascript:;" class="form-wizard-next-btn float-right">Next</a>
                                        </div>
                                    </div>
                                </div>
                            </fieldset> 
                            <fieldset class="wizard-fieldset">
                                <h3>Project Tasks</h3>

                                <div class="row" >
                                    <div class="col-lg-4">
                                        <a class="add-more-task" href="#">Add Task</a>
                                    </div>

                                    <div class="col-lg-4"></div>
                                </div>

                                <div class="row project_tasks" style="display: none;">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="inputProjectTask">Project Task</label>
                                            <input type="text" class="form-control" id="inputProjectTasks" name="project_tasks[]" placeholder="">
                                                
                                            <span class="text-danger input-error project_tasks-error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 control-btn">
                                    </div>
                                </div>

                                <div class="project_tasks_dynamic"></div>

                                <div class="row" >
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="inputApiTemplates" class="wizard-form-text-label">Rest API Templates Items(Multimedia Designers)</label><br/><br/>
                                            <input type="checkbox" id="inputApiTemplates" name="api_templates[]" value="WEB_APP">
                                            <label for=""> Web App</label><br>
                                            <input type="checkbox" id="inputApiTemplates" name="api_templates[]" value="STATIONARIES">
                                            <label for=""> Stationaries</label><br>
                                            <input type="checkbox" id="inputApiTemplates" name="api_templates[]" value="Report">
                                            <label for=""> Report</label><br> 
                                            <input type="checkbox" id="inputApiTemplates" name="api_templates[]" value="SEO_CHECKLIST">
                                            <label for=""> SEO Checklist</label><br> 
                                            <input type="checkbox" id="inputApiTemplates" name="api_templates[]" value="BRING_EDUCATOR_AN_APPLE">
                                            <label for=""> Bring Educator an Apple</label><br> 
                                            <span class="text-danger input-error stakeholders-error"></span>
                                        </div>
                                    </div>
                                </div>
                                    
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group clearfix">
                                            <a href="javascript:;" class="form-wizard-previous-btn float-left">Previous</a>
                                            <a href="javascript:;" class="form-wizard-next-btn float-right">Next</a>
                                        </div>
                                    </div>
                                </div>
                                
                            </fieldset> 
                            <fieldset class="wizard-fieldset management">
                                <h3>Management</h3>
                                <div id="dynamic-project-member-view">
                                    
                                </div>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="inputGitHubRepository">gitHUB Repository </label>
                                            <input type="text" class="form-control" id="inputGitHubRepository" name="github_repository" placeholder="">
                                            <span class="text-danger input-error github_repository-error"></span>
                                        </div>
                                    </div>

                                    <div class="col-lg-4"></div>

                                    <div class="col-lg-4"></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="inputTechnologyUsed">Technology Used </label>
                                            <input type="text" class="form-control" id="inputTechnologyUsed" name="technology_used" placeholder="">
                                            <span class="text-danger input-error technology_used-error"></span>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <br/>
                                        <a class="addmore" style="cursor: pointer;" onclick="add_more_technology()">&nbsp;
                                            Add More Technology
                                        </a>
                                    </div>

                                    <div class="col-lg-4"></div>
                                </div>

                                <h5>Project Technology</h5>
                                <hr/>

                                <div class="row">
                                    <div class="col-lg-12">

                                        <table width="100%" class="table" id="projectTechnologyTable">
                                            <thead>
                                                <tr>
                                                    <th>Technologies</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group clearfix">
                                            <a href="javascript:;" class="form-wizard-previous-btn float-left">Previous</a>
                                            <!-- <a href="javascript:;" class="form-wizard-submit float-right">Submit</a> -->
                                            <button type="submit" class="form-wizard-submit float-right"id="formAddProjectSubmit">Submit</button>

                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="message-box" style="text-align:center;">
                                            
                                        </div>
                                    </div>
                                </div>

                                
                                
                            </fieldset> 
                             
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="inputProjectName">Project Name <span class="required">*</span></label>
                    <input type="text" class="form-control" id="inputProjectName" name="project_name">
                    <span class="text-danger input-error project_name-error"></span>
                </div>
            </div>
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
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="inputProjectManagerId">Project Manager <span class="required">*</span></label>
                    <select class="form-control" id="inputProjectManagerId" name="project_manager_id">
                        <option value="">Select Project Manager</option>
                        <?php foreach ($project_managers as $key => $project_manager) { ?>
                            <option value="<?php echo $project_manager->user_id;?>"><?php echo $project_manager->first_name.' '.$project_manager->last_name;;?></option>
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
                        <option value="REST_API_MD">Rest API Template - Multimedia Designer</option>
                        <option value="REST_API_WD">Rest API Template - Web Development</option>
                        <option value="EMPTY_TEMPLATE">Empty Template</option>
                    </select>
                    <span class="text-danger input-error project_type-error"></span>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="form-group">
                    <label for="inputTotalHours">Total Hour(s) <span class="required">*</span></label>
                    <input type="text" class="form-control" id="inputTotalHours" name="total_hours">
                    <span class="text-danger input-error total_hours-error"></span>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="form-group">
                    <label for="inputStatus">Status <span class="required">*</span></label>
                    <select class="form-control" id="inputStatus" name="status">
                        <option value="">Select Status</option>
                        <option value="0">Active</option>
                        <option value="1">Deactive</option>
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
        </div> -->

        

        
    </div>

    <div class="card-footer">
        <div class="row">
            <div class="col-lg-12">
                <div class="pull-right">
                    
                </div>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">

    jQuery(document).ready(function() {
    // click on next button
    jQuery('.form-wizard-next-btn').click(function() {
        var parentFieldset = jQuery(this).parents('.wizard-fieldset');
        var currentActiveStep = jQuery(this).parents('.form-wizard').find('.form-wizard-steps .active');
        var next = jQuery(this);
        var nextWizardStep = true;
        parentFieldset.find('.wizard-required').each(function(){
            var thisValue = jQuery(this).val();

            if( thisValue == "") {
                jQuery(this).siblings(".wizard-form-error").slideDown();
                nextWizardStep = false;
            }
            else {
                jQuery(this).siblings(".wizard-form-error").slideUp();
            }
        });
        if( nextWizardStep) {
            next.parents('.wizard-fieldset').removeClass("show","400");
            currentActiveStep.removeClass('active').addClass('activated').next().addClass('active',"400");
            next.parents('.wizard-fieldset').next('.wizard-fieldset').addClass("show","400");
            jQuery(document).find('.wizard-fieldset').each(function(){
                if(jQuery(this).hasClass('management')){// Check Class is exist as management
                    $("#dynamic-project-member-view").html("");// Clear that area by ID
                        var member_ids=[]; 
                        $('select[name="project_members[]"] option:selected').each(function() {// Loop through all selected project members
                         member_ids.push($(this).val());// Put selected members to array
                        });

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });


                        $.ajax({
                            url     : "{{URL::to('get-project-member-list')}}",
                            type    : 'POST',
                            data    : {member_ids:member_ids},
                            success : function ( data ){
                                if(data){
                                    $('#dynamic-project-member-view').html(data);
                                    
                                }else{
                                    $('.message-box').html('<div class="alert alert-danger">Something went wrong</div>');
                                }
                            },
                            error: function( data ){
                                alert("Something went wrong");
                            }
                        });


                        
                }
                if(jQuery(this).hasClass('show')){

                    var formAtrr = jQuery(this).attr('data-tab-content');
                    jQuery(document).find('.form-wizard-steps .form-wizard-step-item').each(function(){
                        if(jQuery(this).attr('data-attr') == formAtrr){
                            jQuery(this).addClass('active');
                            var innerWidth = jQuery(this).innerWidth();
                            var position = jQuery(this).position();
                            jQuery(document).find('.form-wizard-step-move').css({"left": position.left, "width": innerWidth});
                        }else{
                            jQuery(this).removeClass('active');
                        }
                    });
                }
            });
        }
    });
    //click on previous button
    jQuery('.form-wizard-previous-btn').click(function() {
        var counter = parseInt(jQuery(".wizard-counter").text());;
        var prev =jQuery(this);
        var currentActiveStep = jQuery(this).parents('.form-wizard').find('.form-wizard-steps .active');
        prev.parents('.wizard-fieldset').removeClass("show","400");
        prev.parents('.wizard-fieldset').prev('.wizard-fieldset').addClass("show","400");
        currentActiveStep.removeClass('active').prev().removeClass('activated').addClass('active',"400");
        jQuery(document).find('.wizard-fieldset').each(function(){
            if(jQuery(this).hasClass('show')){
                var formAtrr = jQuery(this).attr('data-tab-content');
                jQuery(document).find('.form-wizard-steps .form-wizard-step-item').each(function(){
                    if(jQuery(this).attr('data-attr') == formAtrr){
                        jQuery(this).addClass('active');
                        var innerWidth = jQuery(this).innerWidth();
                        var position = jQuery(this).position();
                        jQuery(document).find('.form-wizard-step-move').css({"left": position.left, "width": innerWidth});
                    }else{
                        jQuery(this).removeClass('active');
                    }
                });
            }
        });
    });
    //click on form submit button
    jQuery(document).on("click",".form-wizard .form-wizard-submit" , function(){
        var parentFieldset = jQuery(this).parents('.wizard-fieldset');
        var currentActiveStep = jQuery(this).parents('.form-wizard').find('.form-wizard-steps .active');
        parentFieldset.find('.wizard-required').each(function() {
            var thisValue = jQuery(this).val();
            if( thisValue == "" ) {
                jQuery(this).siblings(".wizard-form-error").slideDown();
            }
            else {
                jQuery(this).siblings(".wizard-form-error").slideUp();
            }
        });
    });
    // focus on input field check empty or not
    jQuery(".form-control").on('focus', function(){
        var tmpThis = jQuery(this).val();
        if(tmpThis == '' ) {
            jQuery(this).parent().addClass("focus-input");
        }
        else if(tmpThis !='' ){
            jQuery(this).parent().addClass("focus-input");
        }
    }).on('blur', function(){
        var tmpThis = jQuery(this).val();
        if(tmpThis == '' ) {
            jQuery(this).parent().removeClass("focus-input");
            jQuery(this).siblings('.wizard-form-error').slideDown("3000");
        }
        else if(tmpThis !='' ){
            jQuery(this).parent().addClass("focus-input");
            jQuery(this).siblings('.wizard-form-error').slideUp("3000");
        }
    });
});


// Add Project Member
$('.add-more-member').click(function() {
  var cloneRow = $('.project_members').clone();// Clone Specific Row

  cloneRow.removeClass('project_members');// Remove Class
  cloneRow.addClass('remove');// Add Remove Class
  cloneRow.show();// Remove Display None
  cloneRow.find('.control-btn').append('<a href="#" class="remove-field btn-remove-member" onclick="remove_member(this)">Remove Customer</a>');
  cloneRow.appendTo('.project_members_dynamic');// Dispaly Clone Data

});

//Remove Project Member
function remove_member(element){
    $(element).closest('.remove').remove();// Remove Closest Class
}


// Add Project Task
$('.add-more-task').click(function() {
  var cloneRow = $('.project_tasks').clone();// Clone Specific Row;
  cloneRow.removeClass('project_tasks');// Remove Class
  cloneRow.addClass('remove');// Add Remove Class
  cloneRow.show();// Remove Display None
  cloneRow.find('.control-btn').append('<a href="#" class="remove-field btn-remove-task" onclick="remove_task(this)">Remove Task</a>');
  cloneRow.appendTo('.project_tasks_dynamic');// Dispaly Clone Data*/

});

//Remove Project Task
function remove_task(element){
    $(element).closest('.remove').remove();// Remove Closest Class
}

//add more role
function add_more_role(){
    $('.input-error').text("");
    var selected_member_id = $("#inputProjectMemberList").val();// Get Selected Id
    var selected_member_text = $("#inputProjectMemberList option:selected" ).text();// Get Selected Text

    var selected_role = $("#inputProjectMemberRole").val();// Get Selected Role
    var selected_estimate_hour = $("#inputProjectEstimateHour").val();// Get Selected Hour

    var rowCount = $('#projectRolesTable tbody tr').length;
    var newRowCount = rowCount+1;

    //if(selected_member_id!="" && selected_role!="" && selected_estimate_hour!=""){

        $('#projectRolesTable tbody').append('<tr data-row="'+newRowCount+'"><td>'+selected_member_text+'<input type="hidden" name="selected_member_ids[]" value="'+selected_member_id+'"/></td><td>'+selected_role+'<input type="hidden" name="selected_roles[]" value="'+selected_role+'"/></td><td>'+selected_estimate_hour+'<input type="hidden" name="selected_estimate_hours[]" value="'+selected_estimate_hour+'"/></td><td><a onclick="remove_role(this)">Remove Role</a></td></tr>');
    /*}else{
        if(selected_member_id==""){
            $(".project_member_list-error").text("Project memeber is required");
        }
        if(selected_role==""){
            $(".project_member_role-error").text("Project role is required");
        }
        if(selected_estimate_hour==""){
            $(".project_estimate_hour-error").text("Estimate hour is required");
        }
    }*/
}

//remove role
function remove_role(element){
    $(element).closest('tr').remove();// Remove Closest Class
}

//add more technology
function add_more_technology(){
    $('.input-error').text("");
    var technologyused = $("#inputTechnologyUsed").val();// Get Technology

    var rowCount = $('#projectTechnologyTable tbody tr').length;
    var newRowCount = rowCount+1;

    if(technologyused!=""){

        $('#projectTechnologyTable tbody').append('<tr data-row="'+newRowCount+'"><td>'+technologyused+'<input type="hidden" name="project_technologies[]" value="'+technologyused+'"/></td><td><a onclick="remove_technology(this)">Remove Technology</a></td></tr>');
    }else{
        if(technologyused==""){
            $(".technology_used-error").html("Technology is required");
        }
    }
}

//remove technology
function remove_technology(element){
    $(element).closest('tr').remove();// Remove Closest Class
}


$(document).ready(function(){
    

    var form = $('#formAddProject'); 

    form.on( 'submit', function(e) {
        e.preventDefault();

        $('.input-error').html("");

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //alert("hello");
        $.ajax({
            url     : "{{URL::to('add-project-process')}}",
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


                