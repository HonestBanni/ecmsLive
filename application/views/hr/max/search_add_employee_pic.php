        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">All Employees Record <hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12" style="min-height:650px;">           
                    <form method="post" action="HrController/search_add_employee_pic">
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
        <div class="form-group col-md-2">
            <?php 
                echo form_dropdown('emp_status_id', $status, $emp_status_id,  'class="form-control"');
            ?>
        </div>                 
        <div class="form-group col-md-2">
            <?php 
                 echo form_dropdown('limit',$limit,$limitId,  'class="form-control"');
            ?>
        </div>
        <input type="submit" name="search" value="Search" class="btn btn-theme">               
                    </form>
            <?php
            if(@$result):        
            ?>        
                   <div class="col-md-12">
                    <p>
            <button type="button" class="btn btn-success">
                <i class="fa fa-check-circle"></i>Total Records: <?php echo count($result);?>
            </button>   
                    </p>
                    </div>
                <?php endif;?>    
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
                            <th width="110">Status</th>
                            <th><i class="icon-plus" style="color:#fff"></i><b> Add Pic</b></th>
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
        <img src="<?php echo base_url();?>assets/images/employee/user.png" width="80" height="80">
                    <?php
                    }else
                    {?>
    <img src="<?php echo base_url();?>assets/images/employee/<?php echo $rec->picture;?>" style="border-radius:10px;" width="80" height="80">
                <?php 
                    }
                    ?></td>
                    <td><?php echo $rec->emp_name;?></td>
                    <td><?php echo $rec->father_name;?></td>
                    <td><?php echo $rec->department;?></td>
                    <td><?php echo $rec->subject;?></td>
                    <td><?php echo $rec->designation;?></td>
                    <td><?php echo $rec->contract;?></td>
                    <td><?php echo $rec->category;?></td>
                    <td><?php echo $rec->title;?></td>
    <td><a class="btn btn-primary btn-sm" href="HrController/add_employee_pic/<?php echo $rec->emp_id;?>"><b>Add Pic</b></a></td>
                            
                        </tr>
<?php
}
 ?>

                    </tbody>
                </table>
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->