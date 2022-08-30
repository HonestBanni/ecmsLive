        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">All Employees Record <span  style="float:right"><a href="<?php echo base_url();?>HrController/add_employee_record" class="btn btn-large btn-primary">Add New Employee</a></span><hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12" style="min-height:650px;">
                    <h4>
<!--
                        <span style="margin-right:30px;color:#208e4c"><?php // echo $pages;?></span> 
                        <span style="margin-left:120px; color:#208e4c">Total Records: <?php // echo $count;?> </span>
-->
                    </h4>              
                    <form method="post" action="HrController/search_employee_records">
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
                echo form_dropdown('cat_id', $category, $cat_id,  'class="form-control" id="hr_category"');
            ?>
        </div>
        <div class="form-group col-md-2">
            <?php 
                echo form_dropdown('contract_type_id', $contract, $contract_type_id,  'class="form-control" id="hr_contract"');
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
        <input type="submit" name="export" value="export" class="btn btn-theme">                 
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
                    <table  class="table table-boxed table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Picture</th>
                            <th width="120">Emp-Name</th>
                            <th width="120">F-Name</th>
                            <th width="70">Designation</th>
                            <th>Cont. Type</th>
                            <th width="70">Category</th>
                            <th>Status</th>
                            <th>Update</th>
                            <th>Add Pic</th>
                            <th>GRANT-IN-AID</th>
                            <th>Research Paper</th>
                            <th>Prof. Education</th>
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
    <td><a href="<?php echo base_url();?>HrController/employee_profile/<?php echo $rec->emp_id;?>" style="text-transform:capitalize;"><?php echo $rec->emp_name;?></a>    
                    </td>
                    <td><?php echo $rec->father_name;?></td>
                    <td><?php echo $rec->designation;?></td>
                    <td><?php echo $rec->contract;?></td>
                    <td><?php echo $rec->category;?></td>
                    <td><?php echo $rec->title;?></td>
    <td><a class="btn btn-success btn-sm" href="HrController/update_employee/<?php echo $rec->emp_id;?>">Update</a></td>
    <td><a class="btn btn-primary btn-sm" href="HrController/upload_employee_pic/<?php echo $rec->emp_id;?>">Add Pic</a></td>
    <td><a class="btn btn-warning btn-sm" href="HrController/grant_in_aid/<?php echo $rec->emp_id;?>">GRANT-IN-AID</a></td>
    <td><a class="btn btn-theme btn-sm" href="HrController/add_research_paper/<?php echo $rec->emp_id;?>">Research Paper</a></td>
    <td><a class="btn btn-danger btn-sm" href="HrController/add_professional_education/<?php echo $rec->emp_id;?>">Professional Education</a></td>
                            
                        </tr>
<?php
}
 ?>

                    </tbody>
                </table>
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
        
                     <script>
            jQuery(document).ready(function(){
               jQuery('#hr_category').on('change',function(){
                   var hr_category = jQuery(this).val();
                   
                   jQuery.ajax({
                        type   : 'post',
                        url    : 'DropdownController/hr_contract_type',
                        data   : {'hr_category':hr_category},
                        success :function(result){
                            $('#hr_contract').html(result);
                       }
                   });
                   
               });
            });
        </script>  