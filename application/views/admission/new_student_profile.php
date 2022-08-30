<?php

if($result):
//    echo '<pre>';print_r($result);die;
    foreach($result as $empRow):  
         $g_occ             = $empRow->guardian_occupation;   
         $applicant_image   = $empRow->applicant_image;   
         $eprel             = $empRow->e_person_relation;
         $rseat_id2         = $empRow->rseats_id1;
         $rseat_id3         = $empRow->rseats_id3;
        $id                 = $empRow->user_id;
        $where_id           = array('id'=>$id);
        $gres = $this->get_model->get_by_id_User('users',$where_id);
?>

  <div class="content container">
       <!-- ******BANNER****** -->
    <div class="row cols-wrapper">
        <div class="col-md-12">
             <?php
                    if($applicant_image == "")
                    {?>
                    <img style="float:right; border-radius:10px;" src="<?php echo base_url();?>assets/images/students/user.png" width="100" height="100">
                    <?php
                    }else
                    {?>
    <img style="float:right; border-radius:10px;" src="<?php echo base_url();?>assets/images/students/<?php echo $applicant_image;?>" width="100" height="100">
                <?php 
                    }
                    ?>
            <h2 align="center"><?php echo $empRow->student_name;?>: Student Profile </h2>
        </div>
    </div>
    <div class="row cols-wrapper">
        <div class="col-md-12">
                <br />    
            <form name="student" method="post" enctype="multipart/form-data" action="<?php echo base_url();?>admin/student_profile/<?php echo $empRow->student_id;?>"> 
        
        <div class="alert alert-info">
            <?php
            $datetime = $empRow->timestamp;
            if($datetime === '0000-00-00'|| $datetime == '1970-01-01'){
                $datetime = '';
                } else {
                $datetime = date("d-m-Y g:i A", strtotime($datetime));
                }
                    ?>
            This Record Inserted By: 
            <strong><?php echo $gres->emp_name;?></strong>,&nbsp;&nbsp;&nbsp;  
            Date and Time: <strong><?php echo $datetime;?></strong>
        </div>      
        <div class="form-group col-md-12">
            <h3 align="left">Admission Info<hr></h3>    
        </div>            
        <div class="form-group col-md-3">
            <label for="usr">Batch Name :</label>
            <input type="text" value="<?php echo $empRow->batch; ?>" class="form-control">      
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Program Name :</label>
            <input type="text" value="<?php echo $empRow->program; ?>" class="form-control">      
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Sub Program Name :</label>
            <input type="text" value="<?php echo $empRow->sub_program; ?>" class="form-control">      
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Form No.:</label>
            <input type="text" value="<?php echo $empRow->form_no; ?>" class="form-control">      
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Reserved Seat 1:</label>
            <input type="text" value="<?php echo $empRow->seat; ?>" class="form-control">      
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Reserved Seat 2:</label>
            <?php
              $reser_seat_2 = $this->db->get_where('reserved_seat',array('rseat_id'=>$rseat_id2))->row();
                if($reser_seat_2){
                 echo '<input class="form-control" type="text" value="'.$reser_seat_2->name.'">';
                    
            }else{
                    echo '<input class="form-control" type="text" value="">';
                }    

            ?>
        </div>         
<!--        <div class="form-group col-md-3">
            <label for="usr">Reserved Seat 3:</label>
            <?php
              $reser_seat_3 = $this->db->get_where('reserved_seat',array('rseat_id'=>$rseat_id3))->row();
                if($reser_seat_3){
                 echo '<input class="form-control" type="text" value="'.$reser_seat_3->name.'">';
                    
            }else{
                    echo '<input class="form-control" type="text" value="">';
                }    

            ?>
        </div>         -->
          <div class="form-group col-md-3">
            <label for="usr">Comment:</label>
            <input type="text" value="<?php echo $empRow->comment; ?>" class="form-control">      
        </div>
        <div class="form-group col-md-3">
            <label for="usr">College no. :</label>
            <input type="text" value="<?php echo $empRow->college_no; ?>" class="form-control">      
        </div>
         <div class="form-group col-md-3">
            <label for="usr">FATA School :</label>
            <input type="text" value="<?php echo $empRow->fata_school; ?>" class="form-control">      
        </div>

        <div class="form-group col-md-3">
                <label>Shift</label>
            <?php 
                $shift_name = $this->db->select('
                    shift.name as shift_name
                    ')
                 ->from('student_record')
                 ->join('shift','shift.shift_id=student_record.shift_id','left outer')   
                 ->where(array('student_id' => $empRow->student_id))
                 ->get()->row();
            ?>
                
            <input type="text" name="shift" value="<?php echo $shift_name->shift_name;?>" class="form-control">
        </div> 
        
        <div class="form-group col-md-3">
                <label>Admission Alotted On:</label>
            <?php 
                $shime = $this->db->select('
                    reserved_seat.name as admitted_in
                    ')
                 ->from('student_record')
                 ->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id','left outer')   
                 ->where(array('student_id' => $empRow->student_id))
                 ->get()->row();
            ?>
                
            <input type="text" name="shift" value="<?php echo $shime->admitted_in;?>" class="form-control">
        </div> 

        <div class="form-group col-md-3">
            <label for="usr">Board University No.:</label>
            <input type="text" value="<?php echo $empRow->bu_number; ?>" class="form-control">      
        </div>
       <div class="form-group col-md-3">
                <label for="usr">Migration Status</label>
                <select class="form-control" name="migration_status">    
            <?php
            
            if($empRow->migration_status == 1):
                
                echo '<option>Yes</option>';
            else:
                echo '<option >No</option>';
            endif;
                
            ?>
                
            
            </select>
            </div> 
            <div class="form-group col-md-6">
                <label for="usr">Migrated Student Detail:</label>
                <input type="text" name="migrated_remarks" value="<?php echo $empRow->migrated_remarks;?>" class="form-control">
            </div>
        
        <div class="form-group col-md-12">
           <h3 align="left">Basic Student Information<hr></h3>      
        </div>

    
        <div class="form-group col-md-3">
            <label for="usr">Student Name:</label>
            <input type="text" value="<?php echo $empRow->student_name; ?>" class="form-control">      
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Student CNIC:</label>
            <input type="text" value="<?php echo $empRow->student_cnic; ?>" class="form-control">      
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Applicant Mob No 1 (SMS):</label>
            <input type="text" name="applicant_mob_no1" value="<?php echo $empRow->applicant_mob_no1;?>" class="form-control phone" >      
        </div>  
        <div class="form-group col-md-3">
            <label for="usr">Applicant Mob No 2:</label>
            <input type="text" name="applicant_mob_no2" value="<?php echo $empRow->applicant_mob_no2;?>" class="form-control phone">      
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Gender:</label>
            <input type="text" value="<?php echo $empRow->genderTitle; ?>" class="form-control">      
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Marital Status:</label>
            <input type="text" value="<?php echo $empRow->marital; ?>" class="form-control">      
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Date of Birth (<small>DD-MM-YYYY</small>):</label>
           <?php
                $date = $empRow->dob;
                if($date === '0000-00-00'|| $date == '1970-01-01'){
                    $date = '';
                    } else {
                    $date = date("d-m-Y", strtotime($date));
                    }
            ?>
            <input type="text" value="<?php echo $date; ?>" class="form-control">      
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Place of Birth:</label>
            <input type="text" value="<?php echo $empRow->place_of_birth; ?>" class="form-control">      
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Blood Group:</label>
            <input type="text" value="<?php echo $empRow->blood; ?>" class="form-control">      
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Country:</label>
            <input type="text" value="<?php echo $empRow->country; ?>" class="form-control">      
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Domicile:</label>
            <input type="text" value="<?php echo $empRow->domicile; ?>" class="form-control">      
        </div>
        <div class="form-group col-md-3">
            <label for="usr">District:</label>
            <input type="text" value="<?php echo $empRow->district; ?>" class="form-control">      
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Religion:</label>
            <input type="text" value="<?php echo $empRow->religion; ?>" class="form-control">      
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Hostel Required:</label>
            <input type="text" value="<?php echo $empRow->hostel_required; ?>" class="form-control">  
        </div> 
        <div class="form-group col-md-6">
            <label for="usr">Address of Institute Last Attended:</label>
            <input type="text" placeholder="Last School Address" name="last_school_address"  class="form-control" value="<?php echo $empRow->last_school_address;?>">      
        </div>             
    <div class="form-group col-md-3">
        <label for="usr">Remarks <small>For Missing Documents</small>:</label>
        <input type="text" placeholder="Remarks" name="remarks1" value="<?php echo $empRow->remarks;?>" class="form-control">        
    </div>
    <div class="form-group col-md-3">
        <label for="usr">General Remarks:</label>
        <input type="text" placeholder="Remarks" name="remarks2" value="<?php echo $empRow->remarks2;?>" class="form-control">        
    </div>
                        
        <div class="form-group col-md-12">
            <h3 align="left">Student's Father Information<hr></h3>     
        </div>                               
    <div class="form-group col-md-3">
            <label for="usr">Father Name:</label>
            <input type="text" value="<?php echo $empRow->father_name; ?>" class="form-control">      
    </div> 
    <div class="form-group col-md-3">
            <label for="usr">Father NIC:</label>
            <input type="text" value="<?php echo $empRow->father_cnic; ?>" class="form-control">      
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Land Line No:</label>
            <input type="text" value="<?php echo $empRow->land_line_no; ?>" class="form-control">      
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Mobile No.1:</label>
            <input type="text" value="<?php echo $empRow->mobile_no; ?>" class="form-control">      
        </div> 
        
        <div class="form-group col-md-3">
            <label for="usr">Network</label>
            <input type="text" value="<?php echo $empRow->mobileNetwork; ?>" class="form-control">      
        </div> 
        
        <div class="form-group col-md-3">
            <label for="usr">Mobile No.2:</label>
            <input type="text" value="<?php echo $empRow->mobile_no2; ?>" class="form-control">      
    </div> 
    <div class="form-group col-md-3">
            <label for="usr">Occupation:</label>
            <input type="text" value="<?php echo $empRow->occupation; ?>" class="form-control">      
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Annual Income:</label>
            <input type="text" value="<?php echo $empRow->annual_income; ?>" class="form-control">      
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Postal Address:</label>
            <input type="text" value="<?php echo $empRow->app_postal_address; ?>" class="form-control">      
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Permanent Address:</label>
            <input type="text" value="<?php echo $empRow->parmanent_address; ?>" class="form-control">      
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Father Email:</label>
            <input type="text" value="<?php echo $empRow->father_email; ?>" class="form-control">      
        </div> 
        
                        
        <div class="form-group col-md-12">
            <h3 align="left">Guardian Information<hr></h3>    
        </div> 
    <div class="form-group col-md-3">
            <label for="usr">Guardian Name:</label>
            <input type="text" value="<?php echo $empRow->guardian_name; ?>" class="form-control">      
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Guardian CNIC:</label>
            <input type="text" value="<?php echo $empRow->guardian_cnic; ?>" class="form-control">      
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Relation:</label>
            <input type="text" value="<?php echo $empRow->relation; ?>" class="form-control">      
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Occupation:</label>
            <?php
              $result = $this->get_model->get_by_id('occupation',array('occ_id'=>$g_occ));
                if($result){
                foreach($result as $orec){

                echo '<input class="form-control" type="text" value="'.$orec->title.'">';
                }     
            }else{
                    echo '<input class="form-control" type="text" value="">';
                }    

            ?>
        </div>  
     <div class="form-group col-md-3">
            <label for="usr">Annual Income:</label>
            <input type="text" value="<?php echo $empRow->g_annual_income; ?>" class="form-control">      
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Land Line No:</label>
            <input type="text" value="<?php echo $empRow->g_land_no; ?>" class="form-control">      
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Mobile No.:</label>
            <input type="text" value="<?php echo $empRow->g_mobile_no; ?>" class="form-control">      
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Postal Address:</label>
            <input type="text" value="<?php echo $empRow->g_postal_address; ?>" class="form-control">      
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Guardian Email:</label>
            <input type="text" value="<?php echo $empRow->g_email; ?>" class="form-control">      
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Physical Status:</label>
            <input type="text" value="<?php echo $empRow->physical_status; ?>" class="form-control">      
        </div>
        
        <div class="form-group col-md-12">
           <h3 align="left">Emergency Person Information<hr></h3>      
        </div>                     
         
        <div class="form-group col-md-3">
            <label for="usr">Emergency Person Name:</label>
            <input type="text" value="<?php echo $empRow->emargency_person_name; ?>" class="form-control">      
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Relation:</label>
           <?php
              $result = $this->get_model->get_by_id('relation',array('relation_id'=>$eprel));
                if($result){
                foreach($result as $rerec){
            ?>
                <input class="form-control" type="text" value="<?php echo $rerec->title; ?>">
                <?php
                }     
            }else{
                ?>
                    <input class="form-control" type="text" value="">
            <?php
            }    
            ?>     
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Emergency Contact 1:</label>
            <input type="text" value="<?php echo $empRow->e_person_contact1; ?>" class="form-control">      
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Emergency Contact 2:</label>
            <input type="text" value="<?php echo $empRow->e_person_contact2; ?>" class="form-control">      
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Student Status:</label>
            <input type="text" value="<?php echo $empRow->student_status; ?>" class="form-control">      
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Bank Receipt No.:</label>
            <input type="text" value="<?php echo $empRow->bank_receipt_no; ?>" class="form-control">      
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Admission Date (<small>DD-MM-YYYY</small>):</label>
            <?php
                $admission_date = $empRow->admission_date;
                if($admission_date === '0000-00-00' || $admission_date == '1970-01-01'){
                    $admission_date = '';
                    } else {
                    $admission_date = date("d-m-Y", strtotime($admission_date));
                    }
            ?>
            <input type="text" value="<?php echo $admission_date; ?>" class="form-control">
        </div>
        <div class="form-group col-md-3">
            <label for="usr">Admission Comment:</label>
            <input type="text" value="<?php echo $empRow->admission_comment; ?>" class="form-control">  
        </div>                       
      <?php
          endforeach;
           endif;
                    ?> 

    <?php
    
    $hostelInfo = $this->db->get_where('hostel_student_record',array('student_id'=>$empRow->student_id))->row();
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
        <label for="usr">Hostel Message No 1:</label>
        <input type="text" name="student_mobile_no_hostel1" value="<?php echo $hostelInfo->student_mobile_no;?>" class="form-control phone" > 
    </div>   
    <div class="form-group col-md-3">
        <label for="usr">Hostel Message No 2:</label>
        <input type="text" name="student_mobile_no_hostel2" value="<?php echo $hostelInfo->student_mobile_no2;?>" class="form-control phone"> 
    </div>   
    <div class="form-group col-md-3">
        <label for="usr">City:</label>
        <input type="text" name="city" value="<?php echo $hostelInfo->city;?>" class="form-control"> 
    </div>   
    
    <?php
    
      endif;
    
    ?>


        <div class="form-group col-md-12">
            <h3 align="left">Student Academic Record </h3>   
        </div>
              
                <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th>Degree</th>
                            <th>Board/University</th>
                            <th>Institute</th>
                            <th>Passing Year</th>
                            <th>Total Marks</th>
                            <th>Obt. Marks</th>
                            <th>%age</th>
                            <th>CGPA</th>
                            <th>Exam Passed</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php
                        if($student_records):
                        foreach($student_records as $rec):
                        ?>
                        <tr class="gradeA">
                            <td><?php echo $rec->Degreetitle;?></td>
                            <td><?php echo $rec->bordTitle;?></td>
                            <td><?php echo $rec->inst_id;?></td>
                            <td><?php echo $rec->year_of_passing;?></td>
                            <td><?php echo $rec->total_marks;?></td>
                            <td><?php echo $rec->obtained_marks;?></td>
                            <td><?php echo $rec->percentage;?> %</td>
                            <td><?php echo $rec->cgpa;?></td>
                            <td><?php echo $rec->exam_type;?></td>
                        </tr>
                        <?php
                        endforeach;
                        endif;
                        ?>
                    </tbody>
                </table>
            <br><br>
            </div>
        </div>



    </div><!--/.content-->