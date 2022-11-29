 <?php
        $emp_id = $result->emp_id;    
        $emp_status_id = $result->emp_status_id;
        $applicant_image = $result->picture;
        ?>
<!-- ******CONTENT****** --> 
        <div class="content container">
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
 <h2 align="left">Update Employee Status (<?php echo $result->emp_name; ?>)<hr></h2>     
        </div>
    </div><br>
            <div class="row cols-wrapper">
                <div class="col-md-12">
    <form name="student" method="post" enctype="multipart/form-data" action="HrController/update_employee_status/<?php echo $emp_id;?>">       
<div class="form-group col-md-3">
    <label for="usr">Employee Name:</label>
    <input class="form-control" type="text" value="<?php echo $result->emp_name; ?>" required>
    <input type="hidden" value="<?php echo $result->emp_id;?>" name="emp_id"> 
</div>
<div class="form-group col-md-3">
    <label for="usr">Father Name:</label>
    <input class="form-control" type="text" value="<?php echo $result->father_name; ?>">    
</div>                        
<div class="form-group col-md-3">
    <label for="usr">Employee Status:</label>
<select class="form-control" type="text" name="retire_status_id">
    <option>&larr; Employee Status &rarr;</option>
    <?php
    $js = $this->db->query("SELECT * FROM hr_retire_status");
    foreach($js->result() as $jsrec)
    {
    ?>
    <option value="<?php echo $jsrec->retire_status_id;?>"><?php echo $jsrec->retire_status;?></option>
    <?php 
    }
    ?>
</select> 
</div>  
<div class="form-group col-md-3">
    <label for="usr">Retired Date:</label>        
<input type="text" name="date" class="form-control date_format_d_m_yy">                          
</div>
<div class="form-group col-md-3">
    <label for="usr">Comment:</label>        
<input type="text" name="remarks" class="form-control">                          
</div> 
<div class="form-group col-md-3">
    <label for="usr">Attach Document:</label>        
<input type="file" name="file" class="form-control">                          
</div>                       
    <div class="form-group col-md-3">
            <input style="margin-top:23px;" type="submit" class="btn btn-primary" name="submit" value="Update Status">
      </div> 
    </form> 
  </div>
                           
                        </div>
                    </div>
    