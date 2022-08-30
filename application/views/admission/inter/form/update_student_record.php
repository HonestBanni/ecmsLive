<?php
    $this->load->helper('form');
    foreach($result as $row);
    $id = $row->student_id;
    $student_name = $row->student_name;
    $batch_id = $row->batch_id;
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
<h2 align="center" style="border-bottom:1px solid #ccc;">Update Student (Inter Level)</h2>   
    <div class="row cols-wrapper">
        <div class="col-md-12">
            
            <form name="student" method="post" enctype="multipart/form-data">       
                <input type="hidden" name="old_batch_id" value="<?php echo $batch_id;?>">
                <input type="hidden" name="old_programe_id" value="<?php echo $programe_id;?>">
                <input type="hidden" name="old_sub_pro_id" value="<?php echo $sub_pro_id;?>">
                <input type="hidden" name="old_rseats_id" value="<?php echo $rseat_id;?>">
                <input type="hidden" name="old_rseats_id2" value="<?php echo $rseat_id2;?>">
                <input type="hidden" name="old_shift_id" value="<?php echo $shift_id;?>">
                <input type="hidden" name="old_mobile_no" value="<?php echo $mob1;?>">
                <input type="hidden" name="old_mobile_no2" value="<?php echo $mob2;?>">
                <input type="hidden" name="old_form_no" value="<?php echo $form_no;?>">
                <input type="hidden" name="old_college_no" value="<?php echo $college_no;?>">
                <input type="hidden" name="old_student_name" value="<?php echo $student_name;?>">
                <input type="hidden" name="old_domicile_id" value="<?php echo $domicile_id;?>">
                <input type="hidden" name="old_student_id" id="StudentID" value="<?php echo $id;?>">
        <h2 align="left">Student Admission Information<hr></h2>
        
        <h4 style="color:red; text-align:center;">
            <?php print_r($this->session->flashdata('msg'));?>
        </h4>
        
        <div class="form-group col-md-3">
            <label for="usr">Batch Name:</label>
                <?php echo form_dropdown('batch_id',$batch,$StudentInfo->batch_id,' class="form-control"  required="required" id="batch_id" readonly="readonly"');?>
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Program Name:</label>
            <?php
                echo form_dropdown('programe_id',$programes_info,$StudentInfo->batch_id,' class="form-control"  required="required" id="batch_id" readonly="readonly"');
            ?>
        </div>  
        <div class="form-group col-md-3">
            <label for="usr">Sub Program:</label>
            <?php
                 if($s_status_id == 1):
                     $sub_programes =  $this->CRUDModel->dropDown('sub_programes', '', 'sub_pro_id', 'name',array('programe_id'=>$StudentInfo->programe_id));
                    echo form_dropdown('sub_pro_id',$sub_programes,$StudentInfo->sub_pro_id,' class="form-control subject_changer"');
                     else:
                     $sub_programes =  $this->CRUDModel->dropDown('sub_programes', '', 'sub_pro_id', 'name',array('sub_pro_id'=>$StudentInfo->sub_pro_id));
                     echo form_dropdown('sub_pro_id',$sub_programes,$StudentInfo->sub_pro_id,' class="form-control subject_changer" readonly="readonly"');
                 endif;
            
            ?>
        </div>  
         
            <div class="form-group col-md-3">
                <label for="usr">Form No.:</label>
                <input type="text" name="form_no" id="form-Checking" value="<?php echo $row->form_no;?>" class="form-control">
            </div>    
            <div class="form-group col-md-3"> 
                <label for="usr">Reserved Seats 1:</label>
                <?php
                if($s_status_id == 1):
                ?>
              <select class="form-control" type="text" name="rseats_id">
                   <?php
                    
                 $gres = $this->db->get_where('reserved_seat',array('rseat_id'=>$rseat_id))->row();
                    if($gres){
                         ?>                   
                <option type="text" value="<?php echo $gres->rseat_id;?>"><?php echo $gres->name;?></option>
                     <?php 
                            
                    }else{
                echo '<option type="text" value=""></option>';
                        }    
                    ?>
                    <option>&larr; Select Quota &rarr;</option>
                    <?php
                    $b = $this->db->query("SELECT * FROM reserved_seat");
                    foreach($b->result() as $brec)
                    {
                    ?>
                    <option value="<?php echo $brec->rseat_id;?>"><?php echo $brec->name;?></option>
                    <?php 
                    }
                    ?>
                </select>
                <?php
                
                
                else:
                    
                ?>
                    
                   <select class="form-control" type="text" name="rseats_id" readonly="readonly">
                   <?php
                    
                $gres = $this->db->get_where('reserved_seat',array('rseat_id'=>$rseat_id))->row();
                    if($gres){
                       ?>                   
                        <option type="text" value="<?php echo $gres->rseat_id;?>"><?php echo $gres->name;?></option>
                     <?php 
                          
                    }    
                    ?>
                     
                </select> 
                    <?php    
                endif;
                
                ?>
            </div>
        
            
        <div class="form-group col-md-3"> 
                <label for="usr">Reserved Seats 2:</label>
                
                <?php if($s_status_id == 1):?>
                     <select class="form-control" type="text" name="rseats_id1">
                   <?php
                $gres = $this->get_model->get_by_id('reserved_seat',array('rseat_id'=>$rseat_id1));
                    if($gres){
                        foreach($gres as $grec){ ?>                   
                            <option type="text" value="<?php echo $grec->rseat_id;?>"><?php echo $grec->name;?></option>
                     <?php 
                        }     
                    }  
                    ?>
                    <option>Reserved Seats 2</option>
                    <?php
                    $b = $this->db->query("SELECT * FROM reserved_seat");
                    foreach($b->result() as $brec){?>
                    <option value="<?php echo $brec->rseat_id;?>"><?php echo $brec->name;?></option>
                    <?php }?>
                </select>
                    
                <?php else: ?>
                
                
                   <?php
                    $gres = $this->db->get_where('reserved_seat',array('rseat_id'=>$rseat_id1))->row();
                 if($gres):
                        echo '<select class="form-control" type="text" name="rseats_id1" readonly="readonly">';
                        echo '<option type="text" value="'.$gres->rseat_id.'">'.$gres->name.'</option>';
                     else:
                         echo '<select class="form-control" type="text" name="rseats_id1">';
                          ?>
                              
                               <?php
                    $b = $this->db->query("SELECT * FROM reserved_seat");
                    foreach($b->result() as $brec){?>
                    <option value="<?php echo $brec->rseat_id;?>"><?php echo $brec->name;?></option>
                    <?php }?>
                              
                              <?php
                    endif;  
                    echo '   </select>';
                    endif;  
                    ?>
            </div>  
            <div class="form-group col-md-3">
                <label for="usr">Reserved Seats 3</label>
                <?php
                if($s_status_id ==1):
                    $rseats_id3           = $this->CRUDModel->dropDown('reserved_seat', '','rseat_id', 'name');
                    echo form_dropdown('rseats_id3',$rseats_id3,$StudentInfo->rseats_id3,' class="form-control"');
                    else:
                        if($StudentInfo->rseats_id3):
                            $rseats_id3           = $this->CRUDModel->dropDown('reserved_seat', '','rseat_id', 'name',array('rseat_id'=>$StudentInfo->rseats_id3));
                            echo form_dropdown('rseats_id3',$rseats_id3,$StudentInfo->rseats_id3,' class="form-control" readonly="readonly" ');
                            else:
                            $rseats_id3           = $this->CRUDModel->dropDown('reserved_seat', '','rseat_id', 'name');
                                echo form_dropdown('rseats_id3',$rseats_id3,$StudentInfo->rseats_id3,' class="form-control" ');
                        endif;
                    
                endif;
                
                
                ?>     
            </div> 
             
            <div class="form-group col-md-3">
                <label for="usr">College No.:</label>
                <?php  
                 if($s_status_id == 1 && empty($college_no)):
                    echo '<input type="text" name="college_no" value="'.$college_no.'" class="form-control" readonly> ';
                 endif;  
                 if($s_status_id != 1 && empty($college_no)):
                    echo '<input type="text" name="college_no" value="'.$college_no.'" class="form-control" id="checking_college_no"> ';
                 endif;  
                 if($s_status_id != 1 && !empty($college_no)):
                    echo '<input type="text" name="college_no" value="'.$college_no.'" class="form-control" readonly> ';
                 endif;  
                 
                 ?>
                 
               
                <!--<input type="text" name="college_no" value="<?php echo $college_no;?>" class="form-control"  id="checking_college_no">-->
                <?php ;?>
            </div> 
            <div class="form-group col-md-3">
                <label for="usr">Comment:</label>
                <input type="text" name="comment" value="<?php echo $row->comment;?>" class="form-control">      
            </div>
            <div class="form-group col-md-3">
                <label for="usr">FATA School:</label>
                <?php
                
                if($s_status_id == 1):
                    ?>
                        <select class="form-control" type="text" name="fata_school">
                            <option value="<?php echo $row->fata_school;?>"><?php echo $row->fata_school;?></option>
                                <option value="">-- Select --</option>
                                <option value="yes">Yes</option>
                                <option value="no">N0</option>
                        </select> 
                        
                        <?php
                    else:
                        
                    ?>
                        <select class="form-control" type="text" name="fata_school">
                            <option value="<?php echo $row->fata_school;?>"><?php echo $row->fata_school;?></option>
                        </select> <?php
                endif;
                ?>
                   
            </div>
            
            <div class="form-group col-md-3">
                <label>Shift</label>
            <?php 
                $shift_name = $this->db->select('
                    shift.name as shift_name
                    ')
                 ->from('student_record')
                 ->join('shift','shift.shift_id=student_record.shift_id','left outer')   
                 ->where(array('student_id' => $id))
                 ->get()->row();
                ?>
                
                <input type="text" name="shift" value="<?php echo $shift_name->shift_name;?>" class="form-control" readonly>
              </div> 
        
            <div class="form-group col-md-3">
                <label>Admission Alotted On</label>
            <select name="rseat_id2" class="form-control" readonly="readonly">
                <?php
            if($s_status_id != 1 && !empty($rseat_id2)):
            $rseat = $this->get_model->get_by_id('reserved_seat',array('rseat_id'=>$rseat_id2));
                foreach($rseat as $rec): ?>                   
        <option type="text" value="<?php echo $rec->rseat_id;?>"><?php echo $rec->name;?></option>
             <?php 
                endforeach;     
                else:
                ?>
                <option value="">Select Seat</option>
                <?php
                $q = $this->CRUDModel->getResults("reserved_seat");
                foreach($q as $Srow):
                ?>
                <option value="<?php echo $Srow->rseat_id;?>"><?php echo $Srow->name;?></option>
                <?php endforeach;
                endif; 
                ?>
            </select>
              </div>     
            <div class="form-group col-md-3">
                <label for="usr">Migration Status</label>
                <select class="form-control" name="migration_status">    
            <?php if($s_status_id == 1):?>
                  <option value="">Select </option>
                    <option value="0">No</option>
                    <option value="1">Yes</option>    
                <?php 
            else:
                 
                ?>
               <option value="<?php echo $migration_status;?>">Yes</option>       
            <?php    
            endif;    
            ?> 
            </select><!--
            --></div>      
            <div class="form-group col-md-6">
                <label for="usr">Migrated Student Detail:</label>
                <input type="text" name="migrated_remarks" value="<?php echo $row->migrated_remarks;?>" class="form-control">
            </div>       
                         <div class="form-group col-md-12">
                                        <h2 align="left">Student Personal Information<hr></h2>
                                    </div>    
   <div class="form-group col-md-3">
        <label for="usr">Student Name:</label>
        <?php
            if($s_status_id != 1 && !empty($student_name)):?>
        <input type="text" name="student_name" value="<?php echo $row->student_name;?>" class="form-control" readonly="readonly">
        <?php else: ?>
        <input type="text" name="student_name" value="<?php echo $row->student_name;?>" class="form-control" required>
        <?php endif;?>
    </div>                                          
    <div class="form-group col-md-3">
        <label for="usr">Student NIC:</label>
        <input type="text" name="student_cnic" value="<?php echo $row->student_cnic;?>" class="form-control nic">      
    </div>  
    <div class="form-group col-md-3">
        <label for="usr">Applicant Mob No 1 (SMS):</label>
        <?php  if($s_status_id == 1 || empty($row->applicant_mob_no1)):?>
        <input type="text" name="applicant_mob_no1"  value="<?php echo $row->applicant_mob_no1;?>"   class="form-control phone">      
         <?php else: ?>
        <input type="text" name="applicant_mob_no1" value="<?php echo $row->applicant_mob_no1;?>" readonly="readonly" class="form-control phone">  
         <?php endif;?>
            
    </div> 
    <div class="form-group col-md-3">
        <label for="usr">Applicant Mob No 2:</label>
        <?php  if($s_status_id == 1 || empty($row->applicant_mob_no2)):?>
        <input type="text" name="applicant_mob_no2"  class="form-control phone">      
        <?php else: ?>
        <input type="text" name="applicant_mob_no2" value="<?php echo $row->applicant_mob_no2;?>" readonly="readonly" class="form-control phone">      
        <?php endif;?>
        
    </div>  
    <div class="form-group col-md-3">
        <label for="usr">Applicant Mob Network:</label>
        <?php 
        
        if(empty($row->std_mobile_network)):
            echo form_dropdown('app_net_id', $mobile_network, $row->std_mobile_network,  'class="form-control" id="app_net_id"'); 
        else:
            
            $ExistMobile = $this->CRUDModel->dropDown('mobile_network', '', 'net_id', 'network',array('net_id'=>$row->std_mobile_network));
            
            
            echo form_dropdown('app_net_id', $ExistMobile, $row->std_mobile_network,  'class="form-control"  readonly="readonly" id="app_net_id"'); 
        endif;
        
        
        ?>
    </div>  
        <div class="form-group col-md-3">
                <label for="usr">Gender:</label>
                <select class="form-control"  type="text" name="gender_id">
                <?php
            $gres = $this->get_model->get_by_id('gender',array('gender_id'=>$gender_id));
                if($gres){
                    foreach($gres as $grec){ ?>                   
            <option type="text" value="<?php echo $grec->gender_id;?>"><?php echo $grec->title;?></option>
                 <?php 
                    }     
                }else{
            echo '<option type="text" value=""></option>';
                    }    
                ?>
                <option>&larr; Select &rarr;</option>
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
                <label for="usr">Marital Status:</label>
                <select class="form-control"  type="text" name="marital_id">
                <?php
            $gres = $this->get_model->get_by_id('marital_status',array('marital_status_id'=>$marital_id));
                if($gres){
                    foreach($gres as $grec){ ?>                   
            <option type="text" value="<?php echo $grec->marital_status_id;?>"><?php echo $grec->title;?></option>
                 <?php 
                    }     
                }else{
            echo '<option type="text" value=""></option>';
                    }    
                ?>
                <option>&larr; Select &rarr;</option>
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
<select class="form-control" type="text" name="bg_id">
<?php
$result = $this->get_model->get_by_id('blood_group',array('b_group_id'=>$bg_id));
        if($result){
            foreach($result as $brec){ 
        ?> 
<option type="text" value="<?php echo $brec->b_group_id;?>"><?php echo $brec->title;?></option>
        <?php
            }     
        }else{
    echo '<option type="text" value=""></option>';
            }    
        ?>
        <option>&larr; Blood Group &rarr;</option>
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
    <label for="usr">Country:</label>
    <select class="form-control" type="text" name="country_id">
        <?php
$result = $this->get_model->get_by_id('country',array('country_id'=>$country_id));
        if($result){
            foreach($result as $brec){ 
        ?> 
<option type="text" value="<?php echo $brec->country_id;?>"><?php echo $brec->name;?></option>
        <?php
            }     
        }else{
    echo '<option type="text" value=""></option>';
            }    
        ?>
        <option>&larr; Nationality &rarr;</option>
        <?php
        $b = $this->db->query("SELECT * FROM country");
        foreach($b->result() as $brec)
        {
        ?>
        <option value="<?php echo $brec->country_id;?>"><?php echo $brec->name;?></option>
        <?php 
        }
        ?>
    </select>
</div>
<div class="form-group col-md-3">  
    <label for="usr">Domicile:</label>                        
<select class="form-control" type="text" name="domicile_id">
    <?php
$result = $this->get_model->get_by_id('domicile',array('domicile_id'=>$domicile_id));
        if($result){
            foreach($result as $brec){ 
        ?> 
<option type="text" value="<?php echo $brec->domicile_id;?>"><?php echo $brec->name;?></option>
        <?php
            }     
        }else{
    echo '<option style="width:24%; height:30px;" type="text" value=""></option>';
            }    
        ?>
    <option>&larr; Domicile &rarr;</option>
    <?php
    $b = $this->db->query("SELECT * FROM domicile");
    foreach($b->result() as $brec)
    {
    ?>
    <option value="<?php echo $brec->domicile_id;?>"><?php echo $brec->name;?></option>
    <?php 
    }
    ?>
</select> 
</div> 
<div class="form-group col-md-3">  
    <label for="usr">District:</label>                        
<select class="form-control" type="text" name="district_id">
    <?php
$result = $this->get_model->get_by_id('district',array('district_id'=>$district_id));
        if($result){
            foreach($result as $brec){ 
        ?> 
<option type="text" value="<?php echo $brec->district_id;?>"><?php echo $brec->name;?></option>
        <?php
            }     
        }else{
    echo '<option type="text" value=""></option>';
            }    
        ?>
    <option>&larr; District &rarr;</option>
    <?php
    $b = $this->db->query("SELECT * FROM district");
    foreach($b->result() as $brec)
    {
    ?>
    <option value="<?php echo $brec->district_id;?>"><?php echo $brec->name;?></option>
    <?php 
    }
    ?>
</select>
</div>
<div class="form-group col-md-3">  
    <label for="usr">Religion:</label>                        
<select class="form-control" type="text" name="religion_id">
     <?php
$result = $this->get_model->get_by_id('religion',array('religion_id'=>$religion_id));
        if($result){
            foreach($result as $brec){ 
        ?> 
<option type="text" value="<?php echo $brec->religion_id;?>"><?php echo $brec->title;?></option>
        <?php
            }     
        }else{
    echo '<option  type="text" value=""></option>';
            }    
        ?>
    <option>&larr; Religion &rarr;</option>
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

  <div class="form-group col-md-6">
            <label for="usr">Address of Institute Last Attended:</label>
            <input type="text" id="last_school" placeholder="Last School Address" name="last_school_address"  class="form-control" value="<?php echo $row->last_school_address;?>">      
    </div>
    <div class="form-group col-md-3">
            <label for="usr">Last Exam Roll No.:</label>
            <?php 
        $where = array('student_id'=>$id);
        $this->db->order_by('serial_no','desc');
        $this->db->from('applicant_edu_detail');
        $this->db->where($where);
        $s = $this->db->get()->row();
        ?>
            <input type="text" placeholder="Last Exam Roll No" name="rollno"  class="form-control" value="<?php echo @$s->rollno;?>">      
    </div>            
    <div class="form-group col-md-3">
        <label for="usr">Remarks <small>For Missing Documents</small>:</label>
        <input type="text" placeholder="Remarks" name="remarks1" value="<?php echo $row->remarks;?>" class="form-control">        
    </div>
    <div class="form-group col-md-6">
        <label for="usr">General Remarks:</label>
            <?php    
            
            if(empty($row->remarks2 || $s_status_id == 1)):
                ?><input type="text" placeholder="Remarks" name="remarks2"  class="form-control" ><?php
                else:
                ?><input type="text" placeholder="Remarks" name="remarks2"  class="form-control"   value="<?php echo $row->remarks2;?>" readonly="readonly"><?php
            endif;
            ?>
        
            
    </div>
        <div class="form-group col-md-3">
        <label for="usr">Student Email:</label>
        <input type="text" value="<?php echo $row->student_email;?>" readonly="readonly" class="form-control">        
    </div>
    <div class="form-group col-md-12"><h2 align="left">Student's Father Information<hr></h2></div>                    
    <div class="form-group col-md-3">
        <label for="usr">Father Name:</label>
        
           <?php  if($s_status_id == 1 && empty($row->father_name)):?>
              <input type="text" name="father_name" vclass="form-control" required>
         <?php else: ?>
          <input type="text" name="father_name" value="<?php echo $row->father_name;?>" class="form-control" required>  
         <?php endif;?>
        
                 
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
        <label for="usr">Mobile No 1 (SMS):</label>
         <?php  if($s_status_id == 1 || empty($row->mobile_no)):?>
              <input type="text" name="mobile_no"  class="form-control phone">
        <?php else: ?>
             <input type="text" name="mobile_no" readonly="readonly" value="<?php echo $row->mobile_no;?>" class="form-control phone"> 
        <?php endif;?>
         
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Mobile No 2:</label>
          <?php  if($s_status_id == 1 || empty($row->mobile_no2)):?>
         <input type="text" name="mobile_no2"  class="form-control phone">
        <?php else: ?>
             <input type="text" name="mobile_no2" readonly="readonly" value="<?php echo $row->mobile_no2;?>" class="form-control phone"> 
        <?php endif;?>
         
    </div>
<div class="form-group col-md-3">
        <label for="usr">Occupation:</label>                        
<select class="form-control" type="text" name="occ_id">
<?php
$result = $this->get_model->get_by_id('occupation',array('occ_id'=>$occ_id));
    if($result){
        foreach($result as $orec){?>
<option value="<?php echo $orec->occ_id;?>"><?php echo $orec->title;?></option>      
    <?php
        }     
    }else{
echo '<option type="text" value=""></option>';
        }    
    ?>
    <option>&larr; Father Occupation &rarr;</option>
    <?php
    $b = $this->db->query("SELECT * FROM occupation");
    foreach($b->result() as $brec)
    {
    ?>
    <option value="<?php echo $brec->occ_id;?>"><?php echo $brec->title;?></option>
    <?php 
    }
    ?>
</select> 
</div>
    <div class="form-group col-md-3">
        <label for="usr">Annual Income:</label>
        <input type="text" name="annual_income" value="<?php echo $row->annual_income;?>" class="form-control">      
    </div>
    <div class="form-group col-md-3">
        <label for="usr">Father Mob Network:</label>
        
         <?php 
        
        if(empty($row->net_id)):
            echo form_dropdown('net_id', $mobile_network, $row->net_id,  'class="form-control" id="net_id"');
        else:
            
            $ExistMobile = $this->CRUDModel->dropDown('mobile_network', '', 'net_id', 'network',array('net_id'=>$row->net_id));
            
            
            echo form_dropdown('net_id', $ExistMobile, $row->net_id,  'class="form-control"  readonly="readonly" id="app_net_id"'); 
        endif;
        
        
        ?>
        
        
        <?php 
        
        
        
        ?>
    </div>            
    <div class="form-group col-md-6">
        <label for="usr">Postal Address:</label>
        <input type="text" name="app_postal_address" value="<?php echo $row->app_postal_address;?>" class="form-control">      
    </div>
    <div class="form-group col-md-6">
        <label for="usr">Permanent Address:</label>
        <input type="text" name="parmanent_address" value="<?php echo $row->parmanent_address;?>" class="form-control">      
    </div> 
    <div class="form-group col-md-3">
        <label for="usr">Father Email:</label>
        <input type="text" name="father_email" value="<?php echo $row->father_email;?>" class="form-control">      
    </div> 
    
    <div class="form-group col-md-12">
        <h2>Student's Guardian Information<hr></h2>     
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
<select class="form-control" type="text" name="relation_with_guardian">
<?php
$result = $this->get_model->get_by_id('relation',array('relation_id'=>$g_relation));
    if($result){
        foreach($result as $rerec){ ?>      
<option value="<?php echo $rerec->relation_id;?>"><?php echo $rerec->title;?></option>  
    <?php 
        }     
    }else{
echo '<option type="text" value=""></option>';
        }    
    ?>                          
    <?php
    $b = $this->db->query("SELECT * FROM relation");
    foreach($b->result() as $brec)
    {
    ?>
    <option value="<?php echo $brec->relation_id;?>"><?php echo $brec->title;?></option>
    <?php 
    }
    ?>
</select> 
                        </div>
<div class="form-group col-md-3">
        <label for="usr">Guardian Occupation:</label>                        
<select class="form-control" type="text" name="guardian_occupation">
<?php
$result = $this->get_model->get_by_id('occupation',array('occ_id'=>$g_occ));
    if($result){
        foreach($result as $grec){?>
<option value="<?php echo $grec->occ_id;?>"><?php echo $grec->title;?></option> 
   <?php
        }     
    }else{
echo '<option  type="text" value=""></option>';
        }    
    ?>                      
    <option>&larr; Guardian Occupation &rarr;</option>
    <?php
    $b = $this->db->query("SELECT * FROM occupation");
    foreach($b->result() as $brec)
    {
    ?>
    <option value="<?php echo $brec->occ_id;?>"><?php echo $brec->title;?></option>
    <?php 
    }
    ?>
</select>
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
    <select class="form-control" type="text" name="physical_status_id">                       
<?php
$result = $this->get_model->get_by_id('physical_status',array('ps_id'=>$ps_id));
    if($result){
        foreach($result as $prec){ 
        ?>    
<option value="<?php echo $prec->ps_id;?>"><?php echo $prec->title;?></option>
     <?php
        }     
    }else{
echo '<option style="width:24%; height:30px;" type="text" value=""></option>';
        }    
    ?>                               
    <option>&larr; Applicant Physical Status &rarr;</option>
    <?php
    $b = $this->db->query("SELECT * FROM physical_status");
    foreach($b->result() as $brec)
    {
    ?>
    <option value="<?php echo $brec->ps_id;?>"><?php echo $brec->title;?></option>
    <?php 
    }
    ?>
</select>
</div> 
    <?php
    
    $hostelInfo = $this->db->get_where('hostel_student_record',array('student_id'=>$id))->row();
//    echo '<pre>';print_R($hostelInfo);
    if($hostelInfo):
        
  
    ?>
 <div class="form-group col-md-12">
    <h2 align="left">Hostel Information<hr></h2>
         
</div> 
    
    <div class="form-group col-md-3">
        <label for="usr">Hostel Guardian Name:</label>
        <input type="text" name="guardian_of_hostel" value="<?php echo $hostelInfo->guardian_of_hostel;?>" class="form-control"> 
    </div>   
    <div class="form-group col-md-3">
        <label for="usr">Hostel Guardian Relation:</label>
        <?php
        
         echo form_dropdown('guardian_of_relation', $guardian_of_relation,$hostelInfo->guardian_hostel_relation,'class="form-control"  required="required" id="batch_id"');
        
        ?>
        
        
        <!--<input type="text" name="guardian_of_relation" value="<?php echo $hostelInfo->guardian_of_hostel;?>" class="form-control">--> 
    </div>   
    <div class="form-group col-md-3">
        <label for="usr">Hostel Message (SMS) No 1 :</label>
        <input type="text" name="student_mobile_no_hostel1" readonly="readonly" value="<?php echo $hostelInfo->student_mobile_no;?>" class="form-control phone"> 
    </div>   
    <div class="form-group col-md-3">
        <label for="usr">Hostel Message No 2:</label>
        <input type="text" name="student_mobile_no_hostel2" readonly="readonly" value="<?php echo $hostelInfo->student_mobile_no2;?>" class="form-control phone"> 
    </div>   
    <div class="form-group col-md-3">
        <label for="usr">City:</label>
        <input type="text" name="city" value="<?php echo $hostelInfo->city;?>" class="form-control"> 
    </div>   
    
    <?php
    
      endif;
    
    ?>
<div class="form-group col-md-12">
    <h2 align="left">Emargency Person Information<hr></h2>
</div> 
<div class="form-group col-md-3">
    <label for="usr">Emergency Person Name:</label>
    <input type="text" name="emargency_person_name" value="<?php echo $row->emargency_person_name;?>" class="form-control">      
</div> 
<div class="form-group col-md-3">
    <label for="usr">Emergency Person Relation:</label>
    <select class="form-control" type="text" name="e_person_relation">
<?php
$result = $this->get_model->get_by_id('relation',array('relation_id'=>$eprel));
    if($result){
        foreach($result as $eprec){ ?> 
<option value="<?php echo $eprec->relation_id;?>"><?php echo $eprec->title;?></option>  
     <?php
        }     
    }else{
echo '<option type="text" value=""></option>';
        }    
    ?>                            
    <option>&larr; Emargency Person Relation &rarr;</option>
    <?php
    $b = $this->db->query("SELECT * FROM relation");
    foreach($b->result() as $brec)
    {
    ?>
    <option value="<?php echo $brec->relation_id;?>"><?php echo $brec->title;?></option>
    <?php 
    }
    ?>
</select>
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
<select class="form-control" type="text" name="s_status_id">
    <?php
$result = $this->get_model->get_by_id('student_status',array('s_status_id'=>$s_status_id));
    if($result){
        foreach($result as $eprec){ ?> 
<option value="<?php echo $eprec->s_status_id;?>"><?php echo $eprec->name;?></option>  
     <?php
        }     
    }else{
echo '<option type="text" value=""></option>';
        }    
    ?>  
    </select>  
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
         <input type="text" name="admission_date" readonly="readonly" value="<?php echo $admission_date;?>" class="form-control">      
</div>
<div class="form-group col-md-3">
    <label for="usr">Admission Comment:</label>
    
       <?php  if($s_status_id == 1 && empty($row->admission_comment)):?>
            <input type="text" name="admission_comment"  class="form-control">     
         <?php else: ?>
            <input type="text" name="admission_comment"  value="<?php echo $row->admission_comment;?>" class="form-control" readonly="readonly">  
         <?php endif;?>
       
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
     
<div class="form-group col-md-10">                       
    <input type="submit" class="btn btn-theme" name="submit" value="Update Student">
     
</div>
<div class="form-group col-md-2">                       
    
    
</div>
    
   
    
    <?php
        if($sub_program_id == 5 || $sub_program_id == 4 || $sub_program_id == 26 || $sub_program_id == 27 ):
           
            echo ' <div id="artsubjectlist">';
         
            if($allSubjects):
                $ssArray = array();
                echo '<div class="form-group col-md-12">
                    <h2 align="left">Subjects for Arts Students<hr></h2>
                    <div class="form-group col-md-12"> 
                        <table class="table table-boxed table-hover">
                            <thead>
                                <tr>    
                                    <th>Computer Science / Arts Subjects</th>
                                </tr>
                            </thead>
                            <tbody><tr><td>';

                foreach($selectsubjects as $sRow):
                    $ssArray[] = $sRow->subject_id;
                endforeach;

                $ssArray1[0] =0;
                $grandArray = array_merge($ssArray1,$ssArray);

                foreach($allSubjects as $resRow):

                    if(array_search($resRow->subject_id,$grandArray)):
                        echo '<div class="form-group col-md-3">
                                  <input type="checkbox" name="checked[]" checked value="'.$resRow->subject_id.'" id="subjectItem" style="zoom:2">&nbsp:
                                  <input type="hidden" name="check_log[]" value="'.$resRow->subject_id.'">
                                  <span style="font-size: 15px;"><strong>'.$resRow->title.'</strong></span>
                              </div>';
                    else:
                        echo '<div class="form-group col-md-3">
                                <input type="checkbox" name="checked[]" value="'.$resRow->subject_id.'" id="subjectItem" style="zoom:2">&nbsp:
                                <span style="font-size: 15px;"><strong>'.$resRow->title.'</strong></span>
                            </div>';
                    endif;
                endforeach;

                        echo 
                            '</td></tr></tbody>
                        </table>
                    </div>
                </div>';
            endif; 
            echo '</div>'; 
            else:
                echo ' <div id="artsubjectlist">';
            echo '</div>'; 
        endif;
    ?>
        
   
    
                        </div>
                        </div>
                    </form> 
                <br><br>
                <h2 align="center">Student Academic Record Details<hr><span style="folat:right"><a href="<?php echo base_url();?>admin/student_academic_record/<?php echo $id;?>" class="btn btn-large btn-primary">Add Academic Record</a></span></h2>
            
                
                
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Student</th>
                            <th>Degree</th>
                            <th>Board/University</th>
                            <th>Institute</th>
                            <th>Passing Year</th>
                            <th>Total Marks</th>
                            <th>Obt. Marks</th>
                            <th>%age</th>
                            <th>CGPA</th>

                        </tr>
                    </thead>
                    <tbody>
                <?php 
                    $q = $this->db->query("SELECT * FROM applicant_edu_detail WHERE student_id='$id'");    
                    foreach($q->result() as $rec)  
                    {
                        $student_id = $rec->student_id;
                        $degree_id = $rec->degree_id;
                        $bu_id = $rec->bu_id;
                        $inst_id = $rec->inst_id;
                       
                        $s = $this->db->query("SELECT * FROM student_record WHERE student_id = '$student_id'");
                        foreach($s->result() as $srec);
                        ?>
                        <tr class="gradeA">
                            <td><?php echo $srec->student_name;?></td>
                            <td><?php
                        $pro = $this->get_model->get_by_id('degree',array('degree_id'=>$degree_id));
                            if($pro){
                                foreach($pro as $grec){
                                echo $grec->title;
                                    }     
                                        }else{
                                 echo '';
                                            }    
                                        ?></td>
                            <td><?php
                        $b = $this->get_model->get_by_id('board_university',array('bu_id'=>$bu_id));
                            if($b){
                                foreach($b as $brec){
                                echo $brec->title;
                                    }     
                                        }else{
                                 echo '';
                                            }    
                                        ?></td>
                            <td><?php echo $rec->inst_id;?></td>
                            <td><?php echo $rec->year_of_passing;?></td>
                            <td><?php echo $rec->total_marks;?></td>
                            <td><?php echo $rec->obtained_marks;?></td>
                            <td><?php echo $rec->percentage;?> %</td>
                            <td><?php echo $rec->cgpa;?></td>
                            <!--             
 <td><a href="<?php // echo base_url();?>admin/delete_academic_rec/<?php // echo $rec->serial_no;?>" 
                                   onclick="return confirm('Are You Sure to Delete This..?')">
     <i class="icon-trash" style="color:red"></i><b></b></a></td>-->
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
<br>
            </div>

        </div>
    </div>

<script>
jQuery(document).ready(function(){
    jQuery('.subject_changer').on('change',function(){
        var subProId = jQuery('.subject_changer').val();
        var stdId   = jQuery('#StudentID').val();
        
        if(subProId == 4 || subProId == 5 || subProId == 26 || subProId == 27){
            jQuery.ajax({
                type   :'post',
                url    :'AdminDeptController/getUpdateCheckSubjects',
                data   :{'subId':subProId, 'stdId':stdId},
                success :function(result){
                    jQuery('#artsubjectlist').show();
                    jQuery('#artsubjectlist').html(result);
                }
            });
        }
        else {
            jQuery('#artsubjectlist').hide();
        }
    });
 });
</script>