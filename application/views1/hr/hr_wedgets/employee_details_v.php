 
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
                        <input type="text" placeholder="Employee Name" disabled="disabled" value="<?php echo $result->father_name; ?>" class="form-control">
                    </div>
<!--                    <div class="col-md-6">
                        <label class="control-label" for="basicinput">Department</label>
                        <input type="text"  placeholder="Employee Name" disabled="disabled" value="<?php ?>" class="form-control">
                    </div>-->
                    <div class="col-md-6">
                        <label class="control-label" for="basicinput">Designation</label>
                        <input type="text" placeholder="Employee Name" disabled="disabled" value="<?php 
                        
                                       $this->db->order_by('contract_id','desc'); 
                                       $this->db->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_contract_reneval.c_renewal_designation_id');
                        $designation = $this->db->get_where('hr_contract_reneval',array('c_renwal_emp_id'=>$result->emp_id))->row();
                        
                        if(!empty($designation)):
                            echo $designation->emp_desg_name;
                        endif;
                        
                        
                        
                        ?>" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="control-label" for="basicinput">Joining Date</label>
                        <input type="text" placeholder="Employee Name" disabled="disabled" value="<?php echo $result->joining_date; ?>" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="control-label" for="basicinput">Employee Status</label>
                        <input type="text" placeholder="Employee Name" disabled="disabled" value="<?php echo $result->emp_status; ?>" class="form-control">
                    </div>
            </div>
            <div class="col-md-4">

                <?php echo form_open_multipart('',array('method'=>'post'));?>
                <!--<form name="student" method="post" enctype="multipart/form-data">-->
                     <div class="col-md-6 col-md-offset-2" >
                        <?php
                            $applicant_image = $result->picture;
                        if($applicant_image == ""):
                            ?> <img style="float:right; border-radius:10px;" src="assets/images/employee/user.png" width="200" height="200"><?php
                        else:
                            echo '<input type="hidden" name="old_image"  value="'.$applicant_image.'" class="form-control">';
                            ?> <img style="float:right;" src="assets/images/employee/<?php echo $applicant_image;?>" width="200" height="200"><?php   
                        endif;
                        ?>
                     </div>
                  <?php echo form_close()?>
            </div>
        </div>
    </div>
</section>
 




 