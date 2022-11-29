        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Employee Retirement<hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">              
                    <form method="post" action="HrController/search_retire_employee">
        <div class="form-group col-md-2">
                <input type="text" name="emp_name" value="<?php if($emp_name): echo $emp_name;endif; ?>"   placeholder="Employee Name" class="form-control">      
        </div>
        <div class="form-group col-md-2">
                <input type="text" name="father_name" value="<?php if($father_name): echo $father_name;endif; ?>"   placeholder="Father Name" class="form-control">      
        </div>
        <div class="form-group col-md-2">
            <?php 
                echo form_dropdown('gender_id', $gender, $gender_id,  'class="form-control"');
            ?>
        </div>
        <div class="form-group col-md-2">
            <?php 
                echo form_dropdown('department_id', $department, $department_id,  'class="form-control"');
            ?>
        </div>
        <div class="form-group col-md-2">
            <?php 
                echo form_dropdown('current_designation', $designation, $current_designation,  'class="form-control"');
            ?>
        </div>
        <div class="form-group col-md-2">
            <?php 
                echo form_dropdown('c_emp_scale_id', $scale, $c_emp_scale_id,  'class="form-control"');
            ?>
        </div>
        <div class="form-group col-md-2">
            <?php 
                echo form_dropdown('cat_id', $category, $cat_id,  'class="form-control"');
            ?>
        </div>
        <div class="form-group col-md-2">
            <?php 
                echo form_dropdown('subject_id', $subject, $subject_id,  'class="form-control"');
            ?>
        </div>
        <input type="submit" name="search" value="Search" class="btn btn-theme">                
                    </form>
                    <br>
                    <br>
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-boxed table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th width="80">Picture</th>
                            <th width="120">Emp-Name</th>
                            <th width="120">F-Name</th>
                            <th width="110">Department</th>
                            <th width="110">Major Subject</th>
                            <th width="110">Designation</th>
                            <th width="110">Contract Type</th>
                            <th width="110">Category</th>
                            <th><i class="icon-edit" style="color:#fff"></i><b> Update Status</b></th>
                        </tr>
                    </thead>
                    <tbody>
<?php
foreach($result as $rec)  
{  
  $picture = $rec->picture;  
    ?>
                        <tr class="gradeA">
                            <td><?php
                    if($picture == "")
                    {?>
        <img src="<?php echo base_url();?>assets/images/employee/user.png" width="60" height="40">
                    <?php
                    }else
                    {?>
    <img src="<?php echo base_url();?>assets/images/employee/<?php echo $rec->picture;?>" style="border-radius:10px;" width="60" height="40">
                <?php 
                    }
                    ?></td>
    <td><a href="<?php echo base_url();?>HrController/employee_profile/<?php echo $rec->emp_id;?>" style="text-transform:capitalize;"><?php echo $rec->emp_name;?></a>    
                    </td>
                    <td><?php echo $rec->father_name;?></td>
                    <td><?php echo $rec->department;?></td>
                    <td><?php echo $rec->subject;?></td>
                    <td><?php echo $rec->designation;?></td>
                    <td><?php echo $rec->contract;?></td>
                    <td><?php echo $rec->category;?></td>
    <td><a href="HrController/update_employee_status/<?php echo $rec->emp_id;?>" class="btn btn-theme btn-sm"><b>Update Status</b></a></td>
                            
                        </tr>
<?php
}
 ?>

                    </tbody>
                </table>
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->