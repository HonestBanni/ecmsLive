<?php
$emp_id = $result->emp_id;
$emp_name = $result->emp_name;
$father_name = $result->father_name;
$applicant_image = $result->picture;
?>
<div class="content container">
               <!-- ******BANNER****** -->
            <h3 align="left">Upload Picture of Employee ( <?php echo $emp_name; ?> )</h3>
        <div class="row cols-wrapper">
        <div class="col-md-12">
<?php
if($applicant_image == "")
{?>
<img style="float:right; border-radius:10px;" src="<?php echo base_url();?>assets/images/employee/user.png" width="100" height="100">
<?php
}else
{?>
<img style="float:right; border-radius:10px;" src="<?php echo base_url();?>assets/images/employee/<?php echo $applicant_image;?>" width="100" height="100">
<?php 
}
?>
            <h4 align="center">Employee: <?php echo $emp_name;?> S/O <?php echo $father_name;?></h4>
        </div>
    </div><br>
            <div class="row cols-wrapper">
                <div style="min-height:400px;" class="col-md-12">
                    <div class="tab-content">
                <form name="student" method="post" enctype="multipart/form-data" action="<?php echo base_url();?>HrController/upload_employee_pic/<?php echo $emp_id;?>"><br><br>
                   <div class="control-group">
                      
                        <label class="control-label" for="basicinput">Upload Picture</label>
                        <div class="controls">
                        <input style="margin-left:300px" type="file" name="file" data-original-title="" class="span8 tip" required>
                        </div>
                    </div>
                    <div class="control-group">
            <div class="controls">
             <input type="submit" class="submit" name="submit" value="Upload Photo">
            </div>
                    </div>
                    </form>
                    </div>    
           </div>
</div><!--/.container-->
</div><!--/.wrapper-->