<form  method="POST" id="formViewRole" class="lcs-form">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Role</th>
                            <th>Estimate Hours</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php 
                        $x = 0;
                        foreach($role_projects as $role_project){ 
                            $x++;
                        ?>
                        <tr>
                            <td><?php echo $x;?></td>
                            <td><?php echo $role_project->project_role;?></td>
                            <td><?php echo $role_project->estimate_hours;?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
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
            </div>
        </div>
    </div>
</form>




                