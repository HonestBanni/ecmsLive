 <?php
        $emp_id = $result->emp_id;    
        $gender_id = $result->gender_id;
        $district_id = $result->district_id;
        $bg_id = $result->bg_id;
        $religion_id = $result->religion_id;
        $contract_type_id = $result->contract_type_id;
        $j_emp_scale_id = $result->j_emp_scale_id;
        $jdesg = $result->joining_designation;
        $cdesg = $result->current_designation;
        $cscale = $result->c_emp_scale_id;
        $country_id = $result->country_id;
        $shift_id = $result->shift_id;
        $subject_id = $result->subject_id;
        $category_id = $result->cat_id;
        $bank_id = $result->bank_id;
        $department_id = $result->department_id;
        $emp_status_id = $result->emp_status_id;
        $account_no = $result->account_no;
        $comment = $result->comment;
        $additional_responsibilty = $result->additional_responsibilty;
        $marital_status_id = $result->marital_status_id;
        $applicant_image = $result->picture;
        ?>
<!-- ******CONTENT****** --> 
        <div class="content container">
            <form name="student" method="post">   
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
 <h2 align="left">Update Employee Profile (<?php echo $result->emp_name; ?>)<hr></h2>     
        </div>
    </div><br>
            <div class="row cols-wrapper">
                <div class="col-md-12">
    

                                <div class="form-group col-md-3">
                                    <label for="usr">Employee Name:</label>
                                    <input class="form-control" type="text" name="emp_name" value="<?php echo $result->emp_name; ?>" required="required">
                                    <input type="hidden" value="<?php echo $result->emp_id;?>" name="emp_id"> 
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="usr">Father Name:</label>
                                    <input class="form-control" type="text" name="father_name" value="<?php echo $result->father_name; ?>" required="required">    
                                </div>                        
                                <div class="form-group col-md-3">
                                    <label for="usr">Husband Name:</label>
                                    <input class="form-control" type="text" name="emp_husband_name" value="<?php echo $result->emp_husband_name; ?>">    
                                </div>                        
                                <div class="form-group col-md-3">
                                    <label for="usr">Gender:</label>
                                     <?php echo form_dropdown('gender_id',$gender,$gender_id,array('class'=>'form-control','required'=>"required"))?> 
                                     
                                </div>                        
                                <div class="form-group col-md-3">
                                    <label for="usr">CNIC:</label>
                                    <input class="form-control nic" type="text" name="nic" required="required" value="<?php echo $result->nic; ?>">    
                                </div>
                                <div class="col-md-3">
                                        <label style="text-indent: 3px">Date of Birth <span style="color:red">*</span></label>
                                        <div>
                                            <div style="width: 33%; float: left" class=" form-group">
                                                
                                                <?php 
                                                 
                                                $dob_day = array();
                                                for($d=1; $d<32; $d++):
                                                    if(strlen($d) < 2): $v = '0'.$d; else: $v = $d; endif;
                                                    $dob_day[$v]= $d; 
                                                endfor;
                                                $dob_d =date('d',strtotime($result->dob)); 
                                                echo form_dropdown('dob_day',$dob_day,$dob_d,array('class'=>'form-control','required'=>"required"));
                                                ?> 
                                            </div>
                                            <div style="width: 33%; float: left" class="form-group" autocomplete="off" >
                                                
                                                <?php
                                                 $month =   $this->CRUDModel->dropDown('month', 'Month', 'mth_num', 'mth_title');
                                                 $dob_m =date('m',strtotime($result->dob)); 
                                                echo form_dropdown('dob_month',$month,$dob_m,array('class'=>'form-control','required'=>"required"));
                                                ?>
                                                 
                                            </div>
                                            <div style="width: 33%; float: left" class="form-group">
                                                 
                                                     
                                                    <?php
                                                     $dob_year = array();
                                                    for($y=1950; $y<=date('Y')-15; $y++):
                                                     $dob_year[$y] = $y;
                                                    endfor;
                                                    
                                                      $dob_y =date('Y',strtotime($result->dob)); 
                                                    echo form_dropdown('dob_year',$dob_year,$dob_y,array('class'=>'form-control','required'=>"required"));
                                                    
                                                    ?>
                                                
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                      
                                <div class="form-group col-md-3">
                                    <label for="usr">Postal Address:</label>
                                    <input class="form-control" type="text" name="postal_address" value="<?php echo $result->postal_address; ?>">    
                                </div>                            
                                <div class="form-group col-md-3">
                                    <label for="usr">Permanent Address::</label>
                                    <input class="form-control" type="text" name="permanent_address" value="<?php echo $result->permanent_address; ?>" required="required">    
                                </div>                            
                                <div class="form-group col-md-3">
                                    <label for="usr">District:</label>
                                    <?php echo form_dropdown('district_id',$district,$district_id,array('class'=>'form-control','required'=>"required"))?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="usr">Post Office:</label>
                                    <input class="form-control" type="text" name="post_office" value="<?php echo $result->post_office; ?>">    
                                </div>        
                                <div class="form-group col-md-3">
                                    <label for="usr">Country:</label>
                                    <?php echo form_dropdown('country_id',$country,$country_id,array('class'=>'form-control','required'=>"required"))?>
                                </div> 
                                 
                                <div class="form-group col-md-3">
                                    <label for="usr">PTCL number:</label>
                                    <input class="form-control" type="text" name="ptcl_number" value="<?php echo $result->ptcl_number; ?>">    
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="usr">Mobile No 1</label>
                                    <input class="form-control phone" type="text" name="contact1" required="required" value="<?php echo $result->contact1; ?>">    
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="usr">Mobile Network:</label>
                                     <?php echo form_dropdown('net_id',$network,$result->net_id,array('class'=>'form-control','required'=>"required"))?>
                                </div>        
                                <div class="form-group col-md-3">
                                    <label for="usr">Mobile No 2</label>
                                    <input class="form-control phone" type="text" name="contact2" value="<?php echo $result->contact2; ?>">    
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="usr">Religion:</label>
                                    <?php echo form_dropdown('religion_id',$religion,$religion_id,array('class'=>'form-control','required'=>"required"))?>
                                    
                                </div> 
                                <div class="form-group col-md-3">
                                    <label for="usr">Marital Status:</label>
                                    <?php echo form_dropdown('marital_status_id',$m_status,$marital_status_id,array('class'=>'form-control'))?>
                                    
                                </div>                           
                                <div class="form-group col-md-3">
                                    <label for="usr">Employee Personal No.:</label>
                                    <input class="form-control" type="text" name="emp_personal_no" value="<?php echo $result->emp_personal_no; ?>">    
                                </div>                        
                                                       
                                <div class="form-group col-md-3">
                                    <label for="usr">Employee email:</label>
                                    <input class="form-control" type="email" name="email" required="required" value="<?php echo $result->email; ?>">    
                                </div>                        
                                 
                                 <div class="form-group col-md-3">
                                    <label for="usr">Current Scale :</label>
                                    <?php echo form_dropdown('c_emp_scale_id',$scale,$cscale,array('class'=>'form-control','required'=>"required"))?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="usr">Current Designation :</label>
                                    <?php echo form_dropdown('current_designation',$designation,$cdesg,array('class'=>'form-control','required'=>"required"))?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="usr">Department:</label>
                                    <?php echo form_dropdown('department_id',$department,$department_id,array('class'=>'form-control','required'=>"required"))?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="usr">Shift:</label>
                                    <?php echo form_dropdown('shift_id',$shift,$shift_id,array('class'=>'form-control','required'=>"required"))?>
                                </div>
<!--                                <div class="form-group col-md-3">
                                    <label for="usr">Bank:</label>
                                    <?php echo form_dropdown('bank_id',$bank,$bank_id,array('class'=>'form-control','required'=>"required"))?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="usr">Account No.:</label>        
                                <input type="text" name="account_no" class="form-control" required="required" value="<?php echo $account_no; ?>">                          
                                </div>-->
                                <div class="form-group col-md-3">
                                    <label for="usr">Employee Category:</label>
                                    <?php echo form_dropdown('cat_id',$category,$category_id,array('class'=>'form-control','id'=>'hr_category','required'=>"required"))?>
                                </div>
<!--                                <div class="form-group col-md-3">
                                    <label for="usr">Employee Job Type :</label>
                                     <?php echo form_dropdown('contract_type_id',$contract_tp,$result->contract_type_id,array('class'=>'form-control','id'=>'hr_contract','required'=>"required"))?> 
                                </div>-->
                                <div class="form-group col-md-3">
                                    <label for="usr">Employee Status:</label>
                                    <?php echo form_dropdown('emp_status_id',$status,$emp_status_id,array('class'=>'form-control','required'=>"required"))?>
                                </div>  
                                <div class="form-group col-md-3">
                                    <label for="usr">Retirement Date:</label>
                                    <input class="form-control datepicker" readonly="readonly" type="text" name="retirement_date" value="<?php echo $this->CRUDModel->date_convert($result->retirement_date); ?>">    
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="usr">Comment:</label>        
                                <input type="text" name="comment" class="form-control" value="<?php echo $comment; ?>">                   
                                </div>
                    </div>
                                <div class="form-group">
                                      <input style="margin-left:30px;" type="submit" class="btn btn-theme" name="submit" value="Update Employee">
                                </div>                      
                        </div>
    
           </form> 
     </div>
         
   
        
        
        
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