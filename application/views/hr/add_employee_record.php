 <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Add New Employee<hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
    <form name="student" method="post" enctype="multipart/form-data" action="HrController/add_employee_record">       
        <div class="row">
            <div class="col-md-12">
    <div class="form-group col-md-3">
        <label for="usr">Employee Name:</label>
        <input type="text" name="emp_name" class="form-control" required>        
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Father Name:</label>
        <input type="text" name="father_name" class="form-control">        
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Husband Name:</label>
        <input type="text" name="emp_husband_name" class="form-control">        
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Gender:</label>
        <select type="text" name="gender_id" class="form-control">
            <option value="">&larr; Gender &rarr;</option>     
            <?php
            $b = $this->db->query("SELECT * FROM gender");
            foreach($b->result() as $brec)
            {
            ?>
                <option value="<?php echo $brec->gender_id;?>"><?php echo $brec->title;?></option>
            <?php 
            }
            ?>
    </select>
    </div>
    <div class="form-group col-md-3">
        <label for="usr">NIC:</label>
        <input type="text" name="nic" id="emp_cnic" class="form-control nic">        
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Date of Birth:</label>
        <input type="text" name="dob" class="form-control date_format_d_m_yy">        
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Postal Address:</label>
        <input type="text" name="postal_address" class="form-control">        
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Permanent Address:</label>
        <input type="text" name="permanent_address" class="form-control">        
    </div>     
    <div class="form-group col-md-3">
        <label for="usr">District:</label>
       <input type="text" name="district_id" class="form-control" id="district">
        <input type="hidden" name="district_id" id="district_id">
    </div>  
    <div class="form-group col-md-3">
        <label for="usr">Post Office:</label>
        <input type="text" name="post_office" class="form-control">        
    </div>
    <div class="form-group col-md-3">
            <label for="usr">Country:</label>
           <input type="text" name="country_id" class="form-control" id="country">
            <input type="hidden" name="country_id" id="country_id">
        </div>
    <div class="form-group col-md-3">
        <label for="usr">Blood Group:</label>
        <select type="text" name="bg_id" class="form-control">
            <option value="">&larr; Select &rarr;</option>     
            <?php
            $b = $this->db->query("SELECT * FROM blood_group");
            foreach($b->result() as $brec)
            {
            ?>
                <option value="<?php echo $brec->b_group_id;?>"><?php echo $brec->title;?></option>
            <?php 
            }
            ?>
    </select>
    </div>            
    <div class="form-group col-md-3">
        <label for="usr">PTCL No.:</label>
        <input type="text" name="ptcl_number" class="form-control">        
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Mobile No 1:</label>
        <input type="text" name="contact1" class="form-control phone">        
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Network:</label>
        <select type="text" name="net_id" class="form-control">
            <option value="">Select Mobile Network</option>
            <?php
        $mn = $this->CRUDModel->getResults("mobile_network");
        foreach($mn as $mrec)
        {
        ?>
            <option value="<?php echo $mrec->net_id;?>"><?php echo $mrec->network;?></option>
        <?php 
        }
        ?>
    </select>
    </div>            
    <div class="form-group col-md-3">
        <label for="usr">Mobile No 2:</label>
        <input type="text" name="contact2" class="form-control phone">        
    </div> 
   <div class="form-group col-md-3">
        <label for="usr">Religion:</label>
        <select type="text" name="religion_id" class="form-control">
            <option value="">&larr; Select &rarr;</option>     
            <?php
        $b = $this->db->query("SELECT * FROM religion");
        foreach($b->result() as $brec)
        {
        ?>
            <option value="<?php echo $brec->religion_id;?>"><?php echo $brec->title;?></option>
        <?php 
        }
        ?>
    </select>
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Marital Status:</label>
        <select type="text" name="marital_status_id" class="form-control">
            <option value="">&larr; Select &rarr;</option>     
            <?php
        $b = $this->db->query("SELECT * FROM marital_status");
        foreach($b->result() as $brec)
        {
        ?>
            <option value="<?php echo $brec->marital_status_id;?>"><?php echo $brec->title;?></option>
        <?php 
        }
        ?>
    </select>
    </div> 
    <div class="form-group col-md-3">
        <label for="usr">Employee Personal No.:</label>
        <input type="text" name="emp_personal_no" class="form-control">        
    </div>
    <div class="form-group col-md-3">
        <label for="usr">GP Fund :</label>
        <input type="text" name="gp_fund_no" class="form-control">        
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Email ID:</label>
        <input type="text" name="email" class="form-control">        
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Employee Job Type.:</label>
        <select type="text" name="contract_type_id" class="form-control" id="hr_contract">
            <option value="">&larr; Select &rarr;</option>     
        <?php
        $b = $this->db->query("SELECT * FROM hr_emp_contract_type");
        foreach($b->result() as $brec)
        {
        ?>
    <option value="<?php echo $brec->contract_type_id;?>"><?php echo $brec->title;?></option>
        <?php 
        }
        ?>
    </select>       
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Joining Scale:</label>
        <select type="text" name="j_emp_scale_id" class="form-control">
            <option value="">&larr; Select &rarr;</option>     
        <?php
    $b = $this->db->query("SELECT * FROM hr_emp_scale");
    foreach($b->result() as $brec)
    {
    ?>
<option value="<?php echo $brec->emp_scale_id;?>"><?php echo $brec->title;?></option>
    <?php 
    }
    ?>
    </select>       
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Joining Designation:</label>
        <select type="text" name="joining_designation" class="form-control">
            <option value="">&larr; Select &rarr;</option>     
        <?php
    $b = $this->db->query("SELECT * FROM hr_emp_designation");
    foreach($b->result() as $brec)
    {
    ?>
<option value="<?php echo $brec->emp_desg_id;?>"><?php echo $brec->title;?></option>
    <?php 
    }
    ?>
    </select>       
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Joining Date:</label>
        <input class="form-control date_format_d_m_yy" type="text" name="joining_date">    
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Current Scale:</label>
        <select type="text" name="c_emp_scale_id" class="form-control">
            <option value="">&larr; Select &rarr;</option>     
        <?php
    $b = $this->db->query("SELECT * FROM hr_emp_scale");
    foreach($b->result() as $brec)
    {
    ?>
<option value="<?php echo $brec->emp_scale_id;?>"><?php echo $brec->title;?></option>
    <?php 
    }
    ?>
    </select>       
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Current Designation:</label>
        <select type="text" name="current_designation" class="form-control">
            <option value="">&larr; Select &rarr;</option>     
        <?php
    $b = $this->db->query("SELECT * FROM hr_emp_designation");
    foreach($b->result() as $brec)
    {
    ?>
<option value="<?php echo $brec->emp_desg_id;?>"><?php echo $brec->title;?></option>
    <?php 
    }
    ?>
    </select>       
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Department:</label>
        <select type="text" name="department_id" class="form-control">
            <option value="">&larr; Select &rarr;</option>     
        <?php
    $b = $this->db->query("SELECT * FROM department");
    foreach($b->result() as $drec)
    {
    ?>
<option value="<?php echo $drec->department_id;?>"><?php echo $drec->title;?></option>
    <?php 
    }
    ?>
    </select>       
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Subject:</label>
        <select type="text" name="subject_id" class="form-control">
            <option value="">&larr; Select &rarr;</option>     
        <?php
    $b = $this->db->query("SELECT * FROM subject");
    foreach($b->result() as $drec)
    {
    ?>
<option value="<?php echo $drec->subject_id;?>"><?php echo $drec->title;?></option>
    <?php 
    }
    ?>
    </select>       
    </div> 
    <div class="form-group col-md-3">
        <label for="usr">Shift:</label>
        <select type="text" name="shift_id" class="form-control">
            <option value="">&larr; Select &rarr;</option>     
       <?php
    $b = $this->db->query("SELECT * FROM shift");
    foreach($b->result() as $drec)
    {
    ?>
<option value="<?php echo $drec->shift_id;?>"><?php echo $drec->name;?></option>
    <?php 
    }
    ?>
    </select>       
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Bank Name:</label>
        <select type="text" name="bank_id" class="form-control">
            <option value="">&larr; Select &rarr;</option>     
       <?php
    $b = $this->db->query("SELECT * FROM bank");
    foreach($b->result() as $drec)
    {
    ?>
<option value="<?php echo $drec->bank_id;?>"><?php echo $drec->name;?></option>
    <?php 
    }
    ?>
    </select>       
    </div>                              
    <div class="form-group col-md-3">
        <label for="usr">Account No.:</label>
        <input class="form-control" type="text" name="account_no">    
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Employee Status:</label>
        <select type="text" name="emp_status_id" class="form-control">
       <option>&larr; Employee Status &rarr;</option>
        <?php
        $js = $this->db->query("SELECT * FROM hr_emp_status");
        foreach($js->result() as $jsrec)
        {
        ?>
        <option value="<?php echo $jsrec->emp_status_id;?>"><?php echo $jsrec->title;?></option>
        <?php 
        }
        ?>
    </select>       
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Comment.:</label>
        <input class="form-control" type="text" name="comment">    
    </div>
    <div class="form-group col-md-6">
        <label for="usr">Additional Responsibilities:</label>
        <input class="form-control" type="text" name="additional_responsibilty">    
    </div>            
    <div class="form-group col-md-3">
        <label for="usr">Employee Category:</label>
        <select type="text" name="cat_id" class="form-control" id="hr_category">
            <option value="">&larr; Select &rarr;</option>     
       <?php
    $b = $this->db->query("SELECT * FROM hr_emp_category");
    foreach($b->result() as $brec)
    {
    ?>
        <option value="<?php echo $brec->cat_id;?>"><?php echo $brec->title;?></option>
    <?php 
    }
    ?>
    </select>       
    </div>
    <div class="form-group col-md-3">
    <label for="usr">Retirement Date:</label>
<input class="form-control date_format_d_m_yy " type="text" name="retirement_date">    
        </div>            
         </div>
      <div class="form-group">
            <input style="margin-left:30px;" type="submit" class="btn btn-primary" name="submit" value="Add Employee">
      </div>

      <!--//form-group-->

    </div>                

                           
                        </div>
                    </div>
                </form> 
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