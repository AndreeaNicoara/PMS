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
                                    <li><span>4</span></li>
                                </ul>
                            </div>

                            
                            <fieldset class="wizard-fieldset">
                                <h3>Project Setup</h3>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="inputProjectType" class="wizard-form-text-label">Project Type <span class="required">*</span></label>
                                            <select class="form-control wizard-required" id="inputProjectType" name="project_type">
                                                <option value=""></option>
                                                <option value="REST_API_MD">Rest API Template - Multimedia Designer</option>
                                                <option value="REST_API_WD">Rest API Template - Web Development</option>
                                                <option value="EMPTY_TEMPLATE">Empty Template</option>
                                            </select>
                                            <span class="text-danger input-error project_type-error wizard-form-error"></span>
                                        </div>
                                    </div>
                                </div>

                            
                                <h5>Project</h5>
                                <hr/>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="inputProjectName" class="wizard-form-text-label">Project Name <span class="required">*</span></label>
                                            <input type="text" class="form-control wizard-required" id="inputProjectName" name="project_name">
                                            <span class="text-danger input-error project_name-error wizard-form-error"></span>
                                        </div>
                                    </div>

                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="inputProjectCode" class="wizard-form-text-label">Project Code <span class="required">*</span></label>
                                            <input type="text" class="form-control wizard-required" id="inputProjectCode" name="project_code">
                                            <span class="text-danger input-error project_code-error wizard-form-error"></span>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="inputProjectDescription" class="wizard-form-text-label">Project Description </label>
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
                                            <label for="inputStartDate" class="wizard-form-text-label">Start Date <span class="required">*</span></label>
                                            <input type="date" class="form-control wizard-required" id="inputStartDate" name="start_date" placeholder="">
                                            <span class="text-danger input-error start_date-error wizard-form-error"></span>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="inputEndDate" class="wizard-form-text-label">End Date <span class="required">*</span></label>
                                            <input type="date" class="form-control wizard-required" id="inputEndDate" name="end_date" placeholder="">
                                            <span class="text-danger input-error end_date-error wizard-form-error"></span>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="inputTotalHours" class="wizard-form-text-label">Total Hour(s) <span class="required">*</span></label>
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
                                            <label for="inputStakeholders" class="wizard-form-text-label">Stakeholder/Partners </label>
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
                                            <label for="inputProjectLeader" class="wizard-form-text-label">Project Leader <span class="required">*</span></label>
                                            <select class="form-control wizard-required" id="inputProjectLeader" name="project_leader" placeholder="">
                                                <option value=""></option>
                                                <?php foreach ($project_managers as $key => $project_manager) { ?>
                                                    <option value="<?php echo $project_manager->user_id;?>"><?php echo $project_manager->first_name.' '.$project_manager->last_name;;?></option>
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
                            <fieldset class="wizard-fieldset management show">
                                <h3>Management</h3>
                                <div id="dynamic-project-member-view">
                                    
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
                            <fieldset class="wizard-fieldset ">
                                <h5>Payment Information</h5>
                                <div class="form-group">
                                    Payment Type
                                    <div class="wizard-form-radio">
                                        <input name="radio-name" id="mastercard" type="radio">
                                        <label for="mastercard">Master Card</label>
                                    </div>
                                    <div class="wizard-form-radio">
                                        <input name="radio-name" id="visacard" type="radio">
                                        <label for="visacard">Visa Card</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control wizard-required" id="honame">
                                    <label for="honame" class="wizard-form-text-label">Holder Name*</label>
                                    <div class="wizard-form-error"></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control wizard-required" id="cardname">
                                            <label for="cardname" class="wizard-form-text-label">Card Number*</label>
                                            <div class="wizard-form-error"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control wizard-required" id="cvc">
                                            <label for="cvc" class="wizard-form-text-label">CVC*</label>
                                            <div class="wizard-form-error"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">Expiry Date</div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="form-group">
                                            <select class="form-control">
                                                <option value="">Date</option>
                                                <option value="">1</option>
                                                <option value="">2</option>
                                                <option value="">3</option>
                                                <option value="">4</option>
                                                <option value="">5</option>
                                                <option value="">6</option>
                                                <option value="">7</option>
                                                <option value="">8</option>
                                                <option value="">9</option>
                                                <option value="">10</option>
                                                <option value="">11</option>
                                                <option value="">12</option>
                                                <option value="">13</option>
                                                <option value="">14</option>
                                                <option value="">15</option>
                                                <option value="">16</option>
                                                <option value="">17</option>
                                                <option value="">18</option>
                                                <option value="">19</option>
                                                <option value="">20</option>
                                                <option value="">21</option>
                                                <option value="">22</option>
                                                <option value="">23</option>
                                                <option value="">24</option>
                                                <option value="">25</option>
                                                <option value="">26</option>
                                                <option value="">27</option>
                                                <option value="">28</option>
                                                <option value="">29</option>
                                                <option value="">30</option>
                                                <option value="">31</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="form-group">
                                            <select class="form-control">
                                                <option value="">Month</option>
                                                <option value="">jan</option>
                                                <option value="">Feb</option>
                                                <option value="">March</option>
                                                <option value="">April</option>
                                                <option value="">May</option>
                                                <option value="">June</option>
                                                <option value="">Jully</option>
                                                <option value="">August</option>
                                                <option value="">Sept</option>
                                                <option value="">Oct</option>
                                                <option value="">Nov</option>
                                                <option value="">Dec</option>   
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="form-group">
                                            <select class="form-control">
                                                <option value="">Years</option>
                                                <option value="">2019</option>
                                                <option value="">2020</option>
                                                <option value="">2021</option>
                                                <option value="">2022</option>
                                                <option value="">2023</option>
                                                <option value="">2024</option>
                                                <option value="">2025</option>
                                                <option value="">2026</option>
                                                <option value="">2027</option>
                                                <option value="">2028</option>
                                                <option value="">2029</option>
                                                <option value="">2030</option>
                                                <option value="">2031</option>
                                                <option value="">2032</option>
                                                <option value="">2033</option>
                                                <option value="">2034</option>
                                                <option value="">2035</option>
                                                <option value="">2036</option>
                                                <option value="">2037</option>
                                                <option value="">2038</option>
                                                <option value="">2039</option>
                                                <option value="">2040</option>  
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <a href="javascript:;" class="form-wizard-previous-btn float-left">Previous</a>
                                    <a href="javascript:;" class="form-wizard-submit float-right">Submit</a>
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
                    <button type="submit" class="btn btn-success form-submit" id="formAddUserSubmit">Submit</button>
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
    var selected_member_id = $("#inputProjectMemberList").val();// Get Selected Id
    var selected_member_text = $("#inputProjectMemberList option:selected" ).text();// Get Selected Text

    var selected_role = $("#inputProjectMemberRole").val();// Get Selected Role
    var selected_member_id = $("#inputProjectEstimateHour").val();// Get Selected Hour
}


// $(document).ready(function(){
    

//     var form = $('#formAddProject'); 

//     form.on( 'submit', function(e) {
//         e.preventDefault();

//         $('.input-error').html("");

//         $.ajaxSetup({
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             }
//         });
//         $.ajax({
//             url     : "{{URL::to('add-project-process')}}",
//             type    : form.attr('method'),
//             data    : form.serialize(),
//             dataType: 'json',
//             success : function ( data ){
//                 if(data.status == true){
//                     $('.message-box').html('<div class="alert alert-success">'+ data.message +'</div>');
//                     setTimeout(function(){
//                         window.location.href = "{{URL::to('manage/project')}}";
//                     }, 1000);
//                 }else{
//                     $('.message-box').html('<div class="alert alert-danger">'+ data.message +'</div>');
//                 }
//             },
//             error: function( data ){
//                 var errors = data.responseJSON;
//                 $.each(data.responseJSON.errors, function (key, value) {
//                     $('.'+key+'-error').html(value);
//                 });
//             }
//         });
//     });
// });
</script>


                