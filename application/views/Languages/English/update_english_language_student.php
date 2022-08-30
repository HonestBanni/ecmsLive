<?php
$this->load->helper('form');

foreach($result as $row);
$id = $row->student_id;
$student_name = $row->student_name;
$batch_id = $row->batch_id;
$lang_status_id = $row->lang_status_id;
$programe_id = $row->programe_id;
$sub_pro_id = $row->sub_pro_id;
$form_no = $row->form_no;
$college_no = $row->college_no;
$fata_school = $row->fata_school;
$rseat_id = $row->rseats_id;
$rseat_id1 = $row->rseats_id1;
$rseat_id2 = $row->rseats_id2;
$comment = $row->comment;
$shift_id = $row->shift_id;
$gender_id = $row->gender_id;
$marital_id = $row->marital_id;
$student_name = $row->student_name;
$student_cnic = $row->student_cnic;
$dob = $row->dob;
$place = $row->place_of_birth;
$bg_id = $row->bg_id;
$country_id = $row->country_id;
$domicile_id = $row->domicile_id;
$district_id = $row->district_id;
$religion_id = $row->religion_id;
$hostel = $row->hostel_required;
$hostel_applied = $row->hostel_applied;
$migrated_remarks = $row->migrated_remarks;
$migration_status = $row->migration_status;
$father = $row->father_name;
$cnic = $row->father_cnic;
$mob1 = $row->mobile_no;
$mob2 = $row->mobile_no2;
$land_no = $row->land_line_no;
$occ_id = $row->occ_id;
$income = $row->annual_income;
$postal = $row->app_postal_address;
$par = $row->parmanent_address;
$email = $row->father_email;
$g_name = $row->guardian_name;
$g_cnic = $row->guardian_cnic;
$g_relation = $row->relation_with_guardian;
$g_occ = $row->guardian_occupation;
$g_email = $row->g_email;
$g_income = $row->g_annual_income;
$g_land_no = $row->g_land_no;
$g_mobile_no = $row->g_mobile_no;
$g_address = $row->g_postal_address;
$g_email = $row->g_email;
$ps_id = $row->physical_status_id;
$epname = $row->emargency_person_name;
$eprel = $row->e_person_relation;
$epcon1 = $row->e_person_contact1;
$epcon2 = $row->e_person_contact2;
$receipt = $row->bank_receipt_no;
$adate = $row->admission_date;
$s_status_id = $row->s_status_id;
$admission_comment = $row->admission_comment;
$applicant_image = $row->applicant_image;
$father_image = $row->father_image;
$bu_number = $row->bu_number;
?>
<div class="content container">
       <!-- ******BANNER****** -->
<h2 align="center">Update Student (English-Language)</h2>    
    <div class="row cols-wrapper">
        <div class="col-md-12">
                <br />
                <div class="tab-cus">
                    <form name="student" method="post" enctype="multipart/form-data">
                <input type="hidden" name="old_batch_id" value="<?php echo $batch_id;?>">
                <input type="hidden" name="old_programe_id" value="<?php echo $programe_id;?>">
                <input type="hidden" name="old_sub_pro_id" value="<?php echo $sub_pro_id;?>">
                <input type="hidden" name="old_rseats_id" value="<?php echo $rseat_id;?>">
                <input type="hidden" name="old_mobile_no" value="<?php echo $mob1;?>">
                <input type="hidden" name="old_mobile_no2" value="<?php echo $mob2;?>">
                <input type="hidden" name="old_form_no" value="<?php echo $form_no;?>">
                <input type="hidden" name="old_college_no" value="<?php echo $college_no;?>">
                <input type="hidden" name="old_student_name" value="<?php echo $student_name;?>">
                <input type="hidden" name="old_domicile_id" value="<?php echo $domicile_id;?>">
                <input type="hidden" name="old_student_id" value="<?php echo $id;?>">
                <h3 align="left">Student Admission Information<hr></h3>
                <div class="form-group col-md-3">
                    <label for="usr">Program Name:</label>
                    <?php  echo form_dropdown('programe_id',$program,$programe_id,array('class'=>'form-control'));?>
                </div>
                <div class="form-group col-md-3">
                    <label for="usr">Sub Program:</label>
                    <?php  echo form_dropdown('sub_pro_id',$sub_program,$sub_pro_id,array('class'=>'form-control'));?>
                </div>
                          
                <div class="form-group col-md-3">
                <label for="usr">Batch Name:</label>
                 <?php  echo form_dropdown('batch_id',$batch,$batch_id,array('class'=>'form-control','id'=>'show_batch_id'));?>
                </div>              
                             
            <div class="form-group col-md-3">
                <label for="usr">Form No.:</label>
                <input type="text" name="form_no" id="form_no_Check" value="<?php echo $row->form_no;?>" class="form-control" readonly>      
            </div>
                <div class="form-group col-md-3">
                <label for="usr">Reserved Seats:</label>
                 <?php  echo form_dropdown('rseats_id',$reserved_seat,$rseat_id,array('class'=>'form-control','id'=>'rseat_id'));?>
                 
                </div> 
             
            <div class="form-group col-md-3">
                <label for="usr">Comment:</label>
                <input type="text" name="comment" value="<?php echo $row->comment;?>" class="form-control">      
            </div> 
            <div class="form-group col-md-3">
                <label for="usr">College No.:</label>
                <?php
            if($s_status_id != 1 && !empty($college_no)):?>
                <input type="text" name="college_no" value="<?php echo $college_no;?>" class="form-control" readonly> 
                <?php else: ?>
                <input type="text" name="college_no" value="<?php echo $college_no;?>" class="form-control" id="checking_college_no">
                <?php endif;?>
            </div> 
            <div class="form-group col-md-3">
                <label for="usr">Board/University No.:</label>
                <input type="text" name="bu_number" value="<?php echo $row->bu_number;?>" class="form-control">      
            </div> 
            <div class="form-group col-md-3">
                <label for="usr">FATA School:</label>
               <select class="form-control" type="text" name="fata_school">
                <option value="<?php echo $row->fata_school;?>"><?php echo $row->fata_school;?></option>
                    <option value="">-- Select --</option>
                    <option value="yes">Yes</option>
                    <option value="no">N0</option>
            </select>     
            </div>
            <div class="form-group col-md-3">
                <label for="usr">Status:</label>
                <?php  echo form_dropdown('lang_status_id',$student_lang,$lang_status_id,array('class'=>'form-control'));?>
            </div>            
            <div class="form-group col-md-3">
                <label for="usr">Migration Status</label>
                <select class="form-control" name="migration_status">    
            <?php
            if($s_status_id != 1 && $migration_status == 1):
            ?>
                <option value="<?php echo $migration_status;?>">Yes</option>
                <?php 
            else:
                ?>
                <option value="">Select </option>
                <option value="0">No</option>
                <option value="1">Yes</option>    
            <?php    
            endif;    
            ?> 
            </select>
            </div>      
            <div class="form-group col-md-3">
                <label for="usr">Migrated Students Detail:</label>
                <input type="text" name="migrated_remarks" value="<?php echo $row->migrated_remarks;?>" class="form-control">
            </div>            
            <div class="form-group col-md-12">
                <h3 align="left">Student Personal Information<hr></h3>
            </div>    
            <div class="form-group col-md-3">
                <label for="usr">Student Name:</label>
        <?php
            if($s_status_id != 1 && !empty($student_name)):?>
        <input type="text" name="student_name" value="<?php echo $row->student_name;?>" class="form-control" readonly>
        <?php else: ?>
        <input type="text" name="student_name" value="<?php echo $row->student_name;?>" class="form-control" required>
        <?php endif;?>
    </div>                                           
    <div class="form-group col-md-3">
        <label for="usr">Student NIC:</label>
        <input type="text" name="student_cnic" value="<?php echo $row->student_cnic;?>" class="form-control nic">      
    </div>  
        <div class="form-group col-md-3">
            <label for="usr">Gender:</label>
            <?php  echo form_dropdown('gender_id',$gender,$gender_id,array('class'=>'form-control'));?>
        </div> 
            <div class="form-group col-md-3">
                <label for="usr">Marital Status:</label>
                <?php  echo form_dropdown('marital_id',$marital,$marital_id,array('class'=>'form-control'));?>
            </div>                  
    <div class="form-group col-md-3">
        <label for="usr">Date of Birth (<small>DD-MM-YYYY</small>):</label>
        <?php
                $date = $row->dob;
                if($date === '0000-00-00' || $date == '1970-01-01'){
                    $date = '';
                    } else {
                    $date = date("d-m-Y", strtotime($date));
                    }
            ?>
    <input type="text" name="dob" value="<?php echo $date;?>" class="form-control date">      
    </div> 
    <div class="form-group col-md-3">
        <label for="usr">Place of Birth:</label>
        <input type="text" name="place_of_birth" value="<?php echo $row->place_of_birth;?>" class="form-control">      
    </div> 
    <div class="form-group col-md-3"> 
        <label for="usr">Blood Group:</label>
        <?php  echo form_dropdown('bg_id',$bloodGroup,$bg_id,array('class'=>'form-control'));?>
    </div>    
<div class="form-group col-md-3">  
    <label for="usr">Country:</label>
    <?php  echo form_dropdown('country',$country,$country_id,array('class'=>'form-control'));?>
     
</div>
<div class="form-group col-md-3">  
    <label for="usr">Domicile:</label>                      
      <?php  echo form_dropdown('domicile_id',$domicile,$domicile_id,array('class'=>'form-control'));?>
 
</div> 
<div class="form-group col-md-3">  
    <label for="usr">District:</label>  
      <?php  echo form_dropdown('district_id',$district,$district_id,array('class'=>'form-control'));?>
 
</div>
<div class="form-group col-md-3">  
    <label for="usr">Religion:</label>  
     <?php  echo form_dropdown('religion_id',$district,$religion_id,array('class'=>'form-control'));?>
 
</div>
<div class="form-group col-md-3">
     <label for="usr">Hostel Required:</label>                        
<select class="form-control" type="text" name="hostel_required">
       <option value="<?php echo $row->hostel_required;?>"></option>
            <option>&larr; Hostel Required &rarr;</option>
    <option value="yes">Yes</option>
    <option value="no">No</option>
    </select>      
</div>                        
   <div class="form-group col-md-3">
        <label for="usr">Student Mobile No:</label>
        
        <input type="text" name="applicant_mob_no1" value="<?php echo $row->applicant_mob_no1;?>" class="form-control" required="required">
    </div>
   <div class="form-group col-md-3">
        <label for="usr">Student Mobile Network:</label>
        <?php  
       
        $mobile_network          = $this->CRUDModel->dropDown('mobile_network', ' Mobile Network ', 'net_id', 'network'); 
        echo form_dropdown('mobile_network_student',$mobile_network,$row->std_mobile_network,array('class'=>'form-control'));  ?>
    </div>
    <div class="form-group col-md-12"><h3 align="left">Student's Father Information<hr></h3></div>                    
    <div class="form-group col-md-3">
        <label for="usr">Father Name:</label>
        <input type="text" name="father_name" value="<?php echo $row->father_name;?>" class="form-control" required>      
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Father NIC:</label>
        <input type="text" name="father_cnic" value="<?php echo $row->father_cnic;?>" class="form-control nic">      
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Land Line No:</label>
        <input type="text" name="land_line_no" value="<?php echo $row->land_line_no;?>" class="form-control">      
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Mobile No:</label>
        <input type="text" name="mobile_no" value="<?php echo $row->mobile_no;?>" class="form-control phone">      
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Mobile No:</label>
        <input type="text" name="mobile_no2" value="<?php echo $row->mobile_no2;?>" class="form-control phone">      
    </div>
    <div class="form-group col-md-3">
            <label for="usr">Occupation:</label>
             <?php  echo form_dropdown('occ_id',$occupation,$occ_id,array('class'=>'form-control'));?>
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Annual Income:</label>
        <input type="text" name="annual_income" value="<?php echo $row->annual_income;?>" class="form-control">      
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Postal Address:</label>
        <input type="text" name="app_postal_address" value="<?php echo $row->app_postal_address;?>" class="form-control">      
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Permanent Address:</label>
        <input type="text" name="parmanent_address" value="<?php echo $row->parmanent_address;?>" class="form-control">      
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Father Email:</label>
        <input type="text" name="father_email" value="<?php echo $row->father_email;?>" class="form-control">      
    </div>
    <div class="form-group col-md-12">
        <h3>Student's Guardian Information<hr></h3>     
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Guardian Name:</label>
        <input type="text" name="guardian_name" value="<?php echo $row->guardian_name;?>" class="form-control">      
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Guardian NIC:</label>
        <input type="text" name="guardian_cnic" value="<?php echo $row->guardian_cnic;?>" class="form-control nic">      
    </div>
<div class="form-group col-md-3">
        <label for="usr">Guardian Relation:</label>  
           <?php  echo form_dropdown('relation_with_guardian',$relation,$g_relation,array('class'=>'form-control'));?>
 
                        </div>
<div class="form-group col-md-3">
        <label for="usr">Guardian Occupation:</label>    
        <?php  echo form_dropdown('guardian_occupation',$occupation,$g_occ,array('class'=>'form-control'));?>
 
</div>
<div class="form-group col-md-3">
    <label for="usr">Annual Income:</label>
    <input type="text" name="g_annual_income" value="<?php echo $row->g_annual_income;?>" class="form-control">      
</div>
<div class="form-group col-md-3">
    <label for="usr">Guardian Landline No:</label>
    <input type="text" name="g_land_no" value="<?php echo $row->g_land_no;?>" class="form-control">      
</div>
<div class="form-group col-md-3">
    <label for="usr">Guardian Mobile No:</label>
    <input type="text" name="g_mobile_no" value="<?php echo $row->g_mobile_no;?>" class="form-control phone">      
</div>
<div class="form-group col-md-3">
    <label for="usr">Postal Address :</label>
    <input type="text" name="g_postal_address" value="<?php echo $row->g_postal_address;?>" class="form-control">      
</div>
<div class="form-group col-md-3">
    <label for="usr">Guardian Email:</label>
    <input type="text" name="g_email" value="<?php echo $row->g_email;?>" class="form-control">      
</div>
<div class="form-group col-md-3">
    <label for="usr">Physical Address :</label>
     <?php  echo form_dropdown('physical_status_id',$physical_status,$ps_id,array('class'=>'form-control'));?>
     
</div> 
<div class="form-group col-md-12">
    <h3 align="left">Emargency Person Information<hr></h3>
</div> 
<div class="form-group col-md-3">
    <label for="usr">Emergency Person Name:</label>
    <input type="text" name="emargency_person_name" value="<?php echo $row->emargency_person_name;?>" class="form-control">      
</div> 
<div class="form-group col-md-3">
    <label for="usr">Emergency Person Relation:</label>
    <?php  echo form_dropdown('e_person_relation',$relation,$eprel,array('class'=>'form-control'));?>
     
</div>    
<div class="form-group col-md-3">
    <label for="usr">Emergency Person Phone 1:</label>
    <input type="text" name="e_person_contact1" value="<?php echo $row->e_person_contact1;?>" class="form-control phone">      
</div>
<div class="form-group col-md-3">
    <label for="usr">Emergency Person Phone 2:</label>
    <input type="text" name="e_person_contact2" value="<?php echo $row->e_person_contact2;?>" class="form-control phone">      
</div>
<div class="form-group col-md-3">
    <label for="usr">Student Status:</label> 
     <?php 
      $status        = $this->CRUDModel->dropDown('student_status', '', 's_status_id', 'name',array('s_status_id'=>$s_status_id));
     
     echo form_dropdown('s_status_id',$status,$s_status_id,array('class'=>'form-control'));?>
 
</div>
 <div class="form-group col-md-3">
    <label for="usr">Bank Receipt No:</label>
    <input type="text" name="bank_receipt_no" value="<?php echo $row->bank_receipt_no;?>" class="form-control">      
</div>
<div class="form-group col-md-3">
    <label for="usr">Admission Date (<small>DD-MM-YYYY</small>):</label>
    <?php
        $admission_date = $row->admission_date;
        if($admission_date === '0000-00-00' || $admission_date == "1970-01-01"){
            $admission_date = '';
            } else {
            $admission_date = date("d-m-Y", strtotime($admission_date));
            }
            ?>
<input type="text" name="admission_date" value="<?php echo $admission_date;?>" class="form-control date">      
</div>
<div class="form-group col-md-3">
    <label for="usr">Admission Comment:</label>
    <input type="text" name="admission_comment" value="<?php echo $row->admission_comment;?>" class="form-control">      
</div>   
<?php
$cons  = $this->CRUDModel->get_where_row('finance_concession',array('student_id'=>$id));
$concsn = '';
if($cons){
$concsn =   $cons->concession ;
}                        
 ?>
<div class="form-group col-md-3"> 
    <label for="usr">Fee Concession:</label>
    <input type="text" name="concession" value="<?php echo $concsn;?>" class="form-control">      
</div>  
<div class="form-group col-md-12">                       
    <input type="submit" class="btn btn-theme" name="submit" value="Update Student">
</div>
                        </div>
                        </div>
                    </form> 
 
            </div>

        </div>
    </div>
