 <?php
        $emp_id = $result->emp_id;    
        $emp_status_id = $result->emp_status_id;
        $applicant_image = $result->picture;
        $cdesg = $result->current_designation;
        $cscale = $result->c_emp_scale_id;
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
    <img style="float:right; border-radius:10px;" src="<?php echo base_url();?>assets/images/employee/<?php echo $applicant_image;?>" width="100" height="70">
        <?php 
            }
            ?>
 <h2 align="left">Employee Promotion/Demotion<hr></h2>     
        </div>
    </div><br>
            <div class="row cols-wrapper">
                <div class="col-md-12">
    <form name="student" method="post" enctype="multipart/form-data" action="HrController/staff_promotion_demotion/<?php echo $emp_id;?>">       
<div class="form-group col-md-3">
    <label for="usr">Employee Name:</label>
    <input class="form-control" type="text" value="<?php echo $result->emp_name; ?>" required>
    <input type="hidden" value="<?php echo $result->emp_id;?>" name="emp_id"> 
    <input type="hidden" value="<?php echo $result->current_designation;?>" name="old_desig_id"> 
    <input type="hidden" value="<?php echo $result->c_emp_scale_id;?>" name="old_scale_id"> 
</div>
<div class="form-group col-md-3">
    <label for="usr">Father Name:</label>
    <input class="form-control" type="text" value="<?php echo $result->father_name; ?>">    
</div>                        
<div class="form-group col-md-3">
    <label for="usr">Current Designation :</label>
<select class="form-control" type="text">
     <?php
$res = $this->HrModel->get_by_id('hr_emp_designation',array('emp_desg_id'=>$cdesg));
    if($res){
        foreach($res as $jrec){ ?>                   
<option type="text" value="<?php echo $jrec->emp_desg_id;?>"><?php echo $jrec->title;?></option>
     <?php 
        }     
    }else{
echo '<option type="text" value=""></option>';
        }    
    ?>
</select> 
</div>
<div class="form-group col-md-3">
    <label for="usr">Current Scale :</label>
<select class="form-control" type="text">
    <?php
$res = $this->HrModel->get_by_id('hr_emp_scale',array('emp_scale_id'=>$cscale));
    if($res){
        foreach($res as $jrec){ ?>                   
<option type="text" value="<?php echo $jrec->emp_scale_id;?>"><?php echo $jrec->title;?></option>
     <?php 
        }     
    }else{
echo '<option type="text" value=""></option>';
        }    
    ?>
</select> 
</div>
<div class="form-group col-md-3">
    <label for="usr">Promotion Designation :</label>
<select class="form-control" type="text" name="pro_desig_id">
    <option>&larr; Select Designation &rarr;</option>
    <?php
    $js = $this->db->query("SELECT * FROM hr_emp_designation");
    foreach($js->result() as $jsrec)
    {
    ?>
    <option value="<?php echo $jsrec->emp_desg_id;?>"><?php echo $jsrec->title;?></option>
    <?php 
    }
    ?>
</select> 
</div>
<div class="form-group col-md-3">
    <label for="usr">Promotion Scale :</label>
<select class="form-control" type="text" name="pro_scale_id">
    <option>&larr; Select Scale &rarr;</option>
    <?php
    $js = $this->db->query("SELECT * FROM hr_emp_scale");
    foreach($js->result() as $jsrec)
    {
    ?>
    <option value="<?php echo $jsrec->emp_scale_id;?>"><?php echo $jsrec->title;?></option>
    <?php 
    }
    ?>
</select> 
</div>
<div class="form-group col-md-3">
    <label for="usr">Promotion Type:</label>
<select class="form-control" type="text" name="promotion_type">
    <option>&larr; Select &rarr;</option>
    <option value="promotion">Promotion</option>
    <option value="demotion">Demotion</option>
</select> 
</div>  
<div class="form-group col-md-3">
    <label for="usr">Promotion Date:</label>        
<input type="text" name="promotion_date" class="form-control date_format_d_m_yy">                       
</div>        
<div class="form-group col-md-3">
    <label for="usr">Remarks:</label>        
<input type="text" name="remarks" class="form-control">                          
</div>                       
    <div class="form-group col-md-3">
            <input style="margin-top:23px;" type="submit" class="btn btn-primary" name="submit" value="Update Status">
      </div> 
    </form> 
  </div>
                           
                        </div>
                    </div>
    