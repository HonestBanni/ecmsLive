 <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
 <?php

    if($result):
        
   $empRow =  $result;
         $cscale = $empRow->c_emp_scale_id;   
         $applicant_image = $empRow->picture;   
         $cdesg = $empRow->current_designation; 
        $date = $empRow->dob;
        $newDate = date("d-m-Y", strtotime($date));  
        $jdate = $empRow->joining_date;   
        $jnewDate = date("d-m-Y", strtotime($jdate));     
        ?>    
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
            <h2 align="left">Employee Profile Mr/Mrs: <?php echo $empRow->emp_name; ?><hr></h2>
                </div>
            </div><br>
            <div class="row cols-wrapper">
                <div class="col-md-12">
    <form name="student" method="post" enctype="multipart/form-data" action="#">       
        
<div class="form-group col-md-3">
  <label for="usr">Employee Name:</label>
  <input type="text" value="<?php echo $empRow->emp_name; ?>" class="form-control"> 
</div>
<div class="form-group col-md-3">
  <label for="usr">Father Name:</label>
  <input type="text" value="<?php echo $empRow->father_name; ?>" class="form-control"> 
</div>                        
<div class="form-group col-md-3">
  <label for="usr">Employee Husband:</label>
  <input type="text" value="<?php echo $empRow->emp_husband_name; ?>" class="form-control"> 
</div>                        
<div class="form-group col-md-3">
  <label for="usr">Gender:</label>
  <input type="text" value="<?php echo $empRow->genderTitle; ?>" class="form-control"> 
</div>                        
<div class="form-group col-md-3">
  <label for="usr">CNIC:</label>
  <input type="text" value="<?php echo $empRow->nic; ?>" class="form-control"> 
</div>                        
<div class="form-group col-md-3">
  <label for="usr">Date of Birth <small>(D-M-Y)</small>:</label>
  <input type="text" value="<?php echo $newDate ?>" class="form-control"> 
</div>                        
<div class="form-group col-md-3">
  <label for="usr">Post Address:</label>
  <input type="text" value="<?php echo $empRow->postal_address; ?>" class="form-control"> 
</div>                        
<div class="form-group col-md-3">
  <label for="usr">Permanent Address:</label>
  <input type="text" value="<?php echo $empRow->permanent_address; ?>" class="form-control"> 
</div>                        
<div class="form-group col-md-3">
  <label for="usr">District:</label>
  <input type="text" value="<?php echo $empRow->district; ?>" class="form-control"> 
</div>                        
<div class="form-group col-md-3">
  <label for="usr">Post Office:</label>
  <input type="text" value="<?php echo $empRow->post_office; ?>" class="form-control"> 
</div>                        
<div class="form-group col-md-3">
  <label for="usr">Country:</label>
  <input type="text" value="<?php echo $empRow->country; ?>" class="form-control"> 
</div>                        
                       
<div class="form-group col-md-3">
  <label for="usr">PTCL No.:</label>
  <input type="text" value="<?php echo $empRow->ptcl_number; ?>" class="form-control"> 
</div>                        
<div class="form-group col-md-3">
  <label for="usr">Contact 1:</label>
  <input type="text" value="<?php echo $empRow->contact1; ?>" class="form-control"> 
</div>                        
<div class="form-group col-md-3">
  <label for="usr">Contact 1 Network:</label>
  <input type="text" value="<?php echo $empRow->network_name; ?>" class="form-control"> 
</div>                        
<div class="form-group col-md-3">
  <label for="usr">Contact 2:</label>
  <input type="text" value="<?php echo $empRow->contact2; ?>" class="form-control"> 
</div>                        
<div class="form-group col-md-3">
  <label for="usr">Religion:</label>
  <input type="text" value="<?php echo $empRow->religion; ?>" class="form-control"> 
</div>                        
<div class="form-group col-md-3">
  <label for="usr">Marital Status:</label>
  <input type="text" value="<?php echo $empRow->marital; ?>" class="form-control"> 
</div>                        
<div class="form-group col-md-3">
  <label for="usr">Employee Personal No.:</label>
  <input type="text" value="<?php echo $empRow->emp_personal_no; ?>" class="form-control"> 
</div>                        
                        
<div class="form-group col-md-3">
  <label for="usr">Email:</label>
  <input type="text" value="<?php echo $empRow->email; ?>" class="form-control"> 
</div>                        
<div class="form-group col-md-3">
  <label for="usr">Contract Type:</label>
  <input type="text" value="<?php echo $empRow->contract; ?>" class="form-control"> 
</div>                        
 
<div class="form-group col-md-3">
  <label for="usr">Current Designation:</label>
<?php
$result = $this->HrModel->get_by_id('hr_emp_designation',array('emp_desg_id'=>$cdesg));
    if($result)
    {
        foreach($result as $drec)
        {
            echo '<input class="form-control" type="text" value="'.$drec->title.'">';
       }     
    }else{
            echo '<input class="form-control" type="text" value="">';
         }    
     ?>    
</div>                        
<div class="form-group col-md-3">
  <label for="usr">Current Scale:</label>
 <?php
$result = $this->HrModel->get_by_id('hr_emp_scale',array('emp_scale_id'=>$cscale));
    if($result)
    {
        foreach($result as $srec)
        {
            echo '<input class="form-control" type="text" value="'.$srec->title.'">';
        }     
    }else{
            echo '<input class="form-control" type="text" value="">';
         }    
     ?> 
</div>                        
<div class="form-group col-md-3">
  <label for="usr">Department:</label>
  <input type="text" value="<?php echo $empRow->department; ?>" class="form-control"> 
</div>
<div class="form-group col-md-3">
  <label for="usr">Shift:</label>
  <input type="text" value="<?php echo $empRow->shiftname; ?>" class="form-control"> 
</div>
<div class="form-group col-md-3">
  <label for="usr">Category:</label>
  <input type="text" value="<?php echo $empRow->categorytitle; ?>" class="form-control"> 
</div>   
<div class="form-group col-md-3">
  <label for="usr">Job Status:</label>
  <input type="text" value="<?php echo $empRow->statustitle; ?>" class="form-control"> 
</div>

        

<div class="form-group col-md-6">
  <label for="usr">Comment:</label>
  <input type="text" value="<?php echo $empRow->comment; ?>" class="form-control"> 
</div>
                 
        <?php
         
           endif;
                        ?>            
                        <div class="col-md-12">
     <h3>Employee Bank Details</h3>
  <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped	 display" width="100%">
      <?php if($bank_dtl): ?> 
      <thead>
            <tr>
                <th>Serial No</th>
                <th>Bank Name </th>
                 <th>Branch Code</th>
                 <th>Account No</th>
                <th>Address</th>
                <th>Status</th>
                
            </tr>
        </thead>
        <tbody>
            <?php $sn = '';
                foreach($bank_dtl as $row):
                    $sn++;
                echo '<tr>
                        <td>'.$sn.'</td>
                        <td>'.$row->bank_name.'</td>
                        <td>'.$row->heb_branch_code.'</td>
                        <td>'.$row->heb_account_no.'</td>
                        <td>'.$row->heb_bank_address.'</td>
                        <td>'.$row->cs_title.'</td>
                        
                    </tr>';
                endforeach;
            ?>
             
        </tbody>
        <?php endif; ?>
    </table>
    
</div>   
                        </div>
                
                    
                    </div>
          
                     
              
        
        
               </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
        
        
