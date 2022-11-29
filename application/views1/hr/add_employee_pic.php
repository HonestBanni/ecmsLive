<?php
$emp_id = $result->emp_id;
$emp_name = $result->emp_name;
$father_name = $result->father_name;
$applicant_image = $result->picture;
?>
<div class="content container">
               <!-- ******BANNER****** -->
            <h3 align="left">Upload Picture of Employee ( <?php echo $emp_name; ?> )<hr></h3>
        <div class="row cols-wrapper">
        <div class="col-md-12">
<?php
if($applicant_image == "")
{?>
<img style="float:right; border-radius:10px;" src="assets/images/employee/user.png" width="80" height="60">
<?php
}else
{?>
<img style="float:right; border-radius:10px;" src="assets/images/employee/<?php echo $applicant_image;?>" width="80" height="60">
<?php 
}
?>
        </div>
    </div><br>
            <div class="row cols-wrapper">
                <div style="min-height:400px;" class="col-md-12">
                <form name="student" method="post" enctype="multipart/form-data" action="HrController/add_employee_pic/<?php echo $emp_id;?>"><br><br>
                   <div class="form-group col-md-4">
                        <label>Upload Picture</label>
                <input type="file" name="file" data-original-title="" class="form-control" required>
                        </div>
                    <div class="control-group col-md-4">
             <input type="submit" style="margin-top:23px;" class="btn btn-theme" name="submit" value="Upload Photo">
                    </div>
                    </form>   
           </div>
</div><!--/.container-->
</div><!--/.wrapper-->