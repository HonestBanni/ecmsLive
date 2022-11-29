 <?php
  $result = $this->HrModel->get_employee_details(array('emp_id'=>$this->input->post('emp_id')));
  
 ?>
<section class="course-finder" style="padding-bottom: 2%;">
    <h1 class="section-heading text-highlight"><span class="line">Employee Information</span></h1>
    <div class="section-content">
        <div class="row">
            <div class="col-md-8">
                <div class="col-md-6">
                    <label class="control-label" for="basicinput">Employee Name</label>
                    <input type="text" name="emp_name" placeholder="Employee Name" disabled="disabled" value="<?php echo $result->emp_name; ?>" class="form-control">

                    </div>
                    <div class="col-md-6">
                        <label class="control-label" for="basicinput">Father Name</label>
                        <input type="text" name="emp_name" placeholder="Employee Name" disabled="disabled" value="<?php echo $result->father_name; ?>" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="control-label" for="basicinput">Department</label>
                        <input type="text" name="emp_name" placeholder="Employee Name" disabled="disabled" value="<?php echo $result->Department; ?>" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="control-label" for="basicinput">Designation</label>
                        <input type="text" name="emp_name" placeholder="Employee Name" disabled="disabled" value="<?php echo $result->Designation; ?>" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="control-label" for="basicinput">Joining Date</label>
                        <input type="text" name="emp_name" placeholder="Employee Name" disabled="disabled" value="<?php echo $result->joining_date; ?>" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="control-label" for="basicinput">Employee Status</label>
                        <input type="text" name="emp_name" placeholder="Employee Name" disabled="disabled" value="<?php echo $result->emp_status; ?>" class="form-control">
                    </div>
            </div>
            <div class="col-md-4">

                <?php echo form_open_multipart('',array('method'=>'post'));?>
                <!--<form name="student" method="post" enctype="multipart/form-data">-->
                     <div class="col-md-6 col-md-offset-2" >
                         <label class="control-label" for="basicinput" style="visibility: hidden;">Employee </label>
                        <?php
                            $applicant_image = $result->picture;
                        if($applicant_image == ""):
                            ?> <img style="float:right; border-radius:10px;" src="assets/images/employee/user.png" width="150" height="150"><?php
                        else:
                            echo '<input type="hidden" name="old_image"  value="'.$applicant_image.'" class="form-control">';
                            ?> <img style="float:right;" src="assets/images/employee/<?php echo $applicant_image;?>" width="150" height="150"><?php   
                        endif;
                        ?>
                     </div>
                  <?php echo form_close()?>
            </div>
        </div>
    </div>
</section>
 




 