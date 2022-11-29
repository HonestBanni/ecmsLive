<div class="content container">
    <div class="page-wrapper">
        <header class="page-heading clearfix">
                <h1 class="heading-title pull-left"><?php echo $breadcrumbs; ?></h1>
                    <div class="breadcrumbs pull-right">
                        <ul class="breadcrumbs-list">
                            <li class="breadcrumbs-label">You are here:</li>
                            <li><a href="Dashboard">Home</a> 
                              <i class="fa fa-angle-right"></i>
                            </li>
                            <li class="current"><?php echo $breadcrumbs; ?></li>
                        </ul>
                    </div>
          <!--//breadcrumbs-->
        </header>
        <div class="page-content">
                    <div class="row">
                        <div class="col-md-12">
                            <section class="course-finder" style="padding-bottom: 2%;">
                                <h1 class="section-heading text-highlight"><span class="line">Employee Details</span></h1>
                                <div class="section-content">
                                    
                                    <div class="row">
                                        
                                        <div class="col-md-6">
                                            <div class="col-md-12">
                                                <label class="control-label" for="basicinput">Employee Name</label>
                                                <input type="text" name="emp_name" placeholder="Employee Name" disabled="disabled" value="<?php echo $result->emp_name; ?>" class="form-control">

                                                </div>
                                                <div class="col-md-12">
                                                    <label class="control-label" for="basicinput">Father Name</label>
                                                    <input type="text" name="emp_name" placeholder="Employee Name" disabled="disabled" value="<?php echo $result->father_name; ?>" class="form-control">
                                                </div>
                                                <div class="col-md-12">
                                                    <label class="control-label" for="basicinput">Department</label>
                                                    <input type="text" name="emp_name" placeholder="Employee Name" disabled="disabled" value="<?php echo $result->Department; ?>" class="form-control">
                                                </div>
                                                <div class="col-md-12">
                                                    <label class="control-label" for="basicinput">Designation</label>
                                                    <input type="text" name="emp_name" placeholder="Employee Name" disabled="disabled" value="<?php echo $result->Designation; ?>" class="form-control">
                                                </div>
                                        </div>
                                        <div class="col-md-6">
                                            
                                            <?php echo form_open_multipart('',array('method'=>'post'));?>
                                            <!--<form name="student" method="post" enctype="multipart/form-data">-->
                                                 <div class="col-md-6 col-md-offset-2" >
                                                    <?php
                                                        $applicant_image = $result->picture;
                                                    if($applicant_image == ""):
                                                        ?> <img style="float:right; border-radius:10px;" src="assets/images/employee/user.png" width="150" height="150"><?php
                                                    else:
                                                        echo '<input type="hidden" name="old_image"  value="'.$applicant_image.'" class="form-control">';
                                                        ?> <img style="float:right; border-radius:10px;" src="assets/images/employee/<?php echo $applicant_image;?>" width="150" height="150"><?php   
                                                    endif;
                                                    ?>
                                                     
                                                     
                                                     
                                                </div>
                                                 <div class="col-md-4 col-md-offset-2">
                                                    <label class="control-label" for="basicinput">Upload Picture</label>
                                                    <input type="file" name="file"  class="form-control" required>
                                                </div>
                                                 <div class="col-md-4 form-group pull-right">
                                                     <label class="control-label" for="basicinput" style="visibility: hidden" >Upload Picture</label>
                                                     <button type="submit" name="UploadPicture" value="UploadPicture"  class="btn btn-theme" ><i class="fa fa-plus"></i> Update Picture</button>
                                                </div>
                                              <?php echo form_close()?>
                                        </div>
                                        
                                        
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
        </div>
        
    </div>
</div>




 