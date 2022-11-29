<?php
    $batch_id = $result->batch_id; 
    $batch_group_id = $result->bg_id; 
    $programe_id = $result->programe_id; 
    $sub_pro_id = $result->sub_pro_id;
    $admitted_to = $result->admitted_to;  
    $occ_id = $result->occ_id; 
    $religion_id = $result->religion_id; 
    $domicile_id = $result->domicile_id; 
    $student_id = $result->student_id; 
    $char_id = $result->char_id; 
    $sports_id = $result->sports_id; 
//    foreach($student_record as $student_record)
//    {
        $inst_id = $student_record->inst_id; 
        $bu_id = $student_record->bu_id; 
        $degree_id = $student_record->degree_id; 
        $grade_id = $student_record->grade_id; 
//    }
    ?>
<!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h3 align="left">Update Green File<hr></h3>
            <div class="row cols-wrapper">
                <div class="col-md-12">
    <form name="student" method="post" enctype="multipart/form-data" action="">
            <div class="row">
            <div class="col-md-12">
              <!--//form-group-->

                <div class="form-group col-md-3">
                    <label for="usr">College No.:</label>
                    <?php if($student_record->batch_id == '81'):?>
                            <input type="text" name="college_no" id="checking_college_no" value="<?php echo $result->college_no;?>" class="form-control">
                    <?php  else: ?>
                            <input type="text" name="college_no" id="checking_college_no" value="<?php echo $result->college_no;?>" class="form-control" readonly="readonly">
                    <?php  endif; ?>
             
                </div>
                <div class="form-group col-md-3">
                    <label for="usr">Reg No.:</label>
         <input type="text" name="board_regno" value="<?php echo $result->board_regno;?>" class="form-control" id="checking_board_regno">
              </div>
                <div class="form-group col-md-3">
                    <label for="usr">Uni Reg No.:</label>
                    <input type="text" name="uni_regno" value="<?php echo $result->uni_regno;?>" class="form-control">
              </div>
            
              <?php
              if($result->s_status_id == '5'):
                  ?>
               <div class="form-group col-md-3">
                    <label for="usr">Student Name:</label>
                    <input type="text" name="student_name" readonly="readonly" value="<?php echo $result->student_name;?>" class="form-control" required>        
              </div>
                      <?php
                  else:
                      ?>
                          <div class="form-group col-md-3">
                    <label for="usr">Student Name:</label>
                    <input type="text" name="student_name" value="<?php echo $result->student_name;?>" class="form-control" required>        
              </div>
       <?php
              endif;
              ?>
                
             
              <div class="form-group col-md-3">
                    <label for="usr">Student CNIC:</label>
                    <input type="text" name="student_cnic" value="<?php echo $result->student_cnic;?>" class="form-control nic">        
              </div>
                <div class="form-group col-md-3">
                    <label for="usr">Father Name:</label>
                    <input type="text" name="father_name" value="<?php echo $result->father_name;?>" class="form-control">
              </div>
                <div class="form-group col-md-3">
                <label for="usr">Occupation:</label>
                
                <?php
                    echo form_dropdown('occ_id', $occupation,$occ_id,  'class="form-control"');
                ?>
                </div>
              <div class="form-group col-md-3">
                    <label for="usr">Religion:</label>
                    <?php
                        echo form_dropdown('religion_id', $religion,$religion_id,  'class="form-control"');
                    ?>
               </div>
                <div class="form-group col-md-3">
                    <label for="usr">Domicile:</label>
                    
                     <?php

           
            if($domicile){
                foreach($domicile as $grec){ ?>          
                <input type="text" required="required" name="domicile_id" value="<?php echo $grec->name; ?>" placeholder="Domicile" class="form-control" id="domicile">
                <input type="hidden" name="domicile_id" id="domicile_id" value="<?php echo $grec->domicile_id; ?>">      
                <?php 
                }     
            }else{?>
                <input type="text" name="domicile_id" placeholder="Domicile" class="form-control" id="domicile" required="required">
                    <input type="hidden" name="domicile_id" id="domicile_id">    
                <?php
                }    
            ?>  
              </div>
              <div class="form-group col-md-3">
                  <label for="usr">Date of Birth <small>(DD-MM-YYYY)</small>:</label>
                  <?php
                $dob = $result->dob;
                if($dob === '0000-00-00' || $dob == '1970-01-01'){
                    $dob = '';
                    } else {
                    $dob = date("d-m-Y", strtotime($dob));
                    }
            ?>
                    <input type="text" class="form-control date_format_d_m_yy" value="<?php echo $dob;?>" name="dob"> 
              </div>
              
              
               <div class="form-group col-md-3">
                    <label for="usr">Phone No 1.:</label>
                    <input type="text" class="form-control" value="<?php echo $result->mobile_no;?>" name="mobile_no"> 
              </div>
              <div class="form-group col-md-3">
                    <label for="usr">Phone No 2:</label>
                    <input type="text" class="form-control" value="<?php echo $result->mobile_no2;?>" name="mobile_no2"> 
              </div>
              <div class="form-group col-md-12">
                    <label for="usr">Parmanent Address:</label>
                <input type="text" class="form-control" value="<?php echo $result->parmanent_address;?>" name="parmanent_address"> 
              </div>
              <div class="form-group col-md-12">
                    <label for="usr">Postal Address:</label>
                <input type="text" class="form-control" value="<?php echo $result->app_postal_address;?>" name="app_postal_address"> 
              </div>
               <div class="form-group col-md-3">
                    <label for="usr">Sports:</label>
                        <?php
                            echo form_dropdown('sports_id', $sports,$sports_id,  'class="form-control"');
                        ?>
                </div> 
               <div class="form-group col-md-3">
                    <label for="usr">Blood Group:</label>
                        <?php
                            echo form_dropdown('blood_group', $blood_group,$batch_group_id,  'class="form-control"');
                        ?>
                </div> 
             
<!--              <div class="form-group col-md-3">
                    <label for="usr">Hostel/Day Scholar :</label>
                    <select type="text" name="hostel_required" class="form-control">
                        <option value="<?php echo $result->hostel_required;?>"><?php echo $result->hostel_required;?></option>
                        <option value="">Select </option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>   
              </div> -->
              <div class="form-group col-md-3">
                    <label for="usr">Previous Institute:</label>
                    <input type="text" class="form-control" value="<?php echo $inst_id;?>" name="std_inst_id"> 
              </div>
                <div class="form-group col-md-3">
                    <label for="usr">Exam Passed:</label>
                        <?php
                            echo form_dropdown('std_degree_id', $degree,$degree_id,  'class="form-control"');
                        ?>
                    
              </div>
                <div class="form-group col-md-3">
                    <label for="usr">Year:</label>
                    <input type="text" class="form-control" value="<?php echo $student_record->year_of_passing;?>" name="std_year_of_passing"> 
                </div>
                <div class="form-group col-md-3">
                    <label for="usr">Roll No:</label>
                    <input type="text" class="form-control" value="<?php echo $student_record->rollno;?>"name="std_rollno"> 
              </div>
                
              <div class="form-group col-md-3">
                  <label for="usr">Current Status:</label>  
                  <input type="text" class="form-control" value="<?php echo $result->name;?>" readonly="readonly">
                     
              </div>
              <div class="form-group col-md-3">
                  <label for="usr">Program</label>  
                  
                   <?php 
                        if($student_record->batch_id == '81'): 
                            echo form_dropdown('program_std', $program_std,$student_record->programe_id,  'class="form-control" id="feeProgrameId"');
                       else:
                         $program_details =   $this->CRUDModel->get_where_row('programes_info',array('programe_id'=>$student_record->programe_id));
//                       echo '<pre>';print_r($program);die;
                           echo '<input type="text" class="form-control" value="'.$program_details->programe_name.'" readonly="readonly">';
                           echo '<input type="hidden" name="program_std" class="form-control" value="'.$program_details->programe_id.'" readonly="readonly">';
//                            form_dropdown('program_std', $program_std,$student_record->programe_id,  'class="form-control" disabled="disabled" ');
                        endif; ?>
                   
              </div>
              <div class="form-group col-md-3">
                  <label for="usr">Admitted To the:</label>   
                  
                  <?php 
                        if($student_record->batch_id == '81'): 
                            echo form_dropdown('std_admitted_to', $admitted,$admitted_to,  'class="form-control" id="showFeeSubPro"');
                       else: 
                            
                           $sub_pro_details = $this->CRUDModel->get_where_row('sub_programes',array('sub_pro_id'=>$admitted_to));
                       
                           echo '<input type="text" class="form-control" value="'.@$sub_pro_details->name.'" readonly="readonly">';
                           echo '<input type="hidden" name="std_admitted_to" class="form-control" value="'.@$sub_pro_details->sub_pro_id.'" readonly="readonly">';
//                             form_dropdown('std_admitted_toss', $sub_pro_details,$admitted_to,  'class="form-control"  readonly="readonly"');
                            
                        endif; ?>
                  
                     
              </div>
            <div class="form-group col-md-3">
                    <label for="usr">Total Marks:</label>
                    
                    <?php if($student_record->batch_id == '81'):?>
                            <input type="text" class="form-control" value="<?php echo $student_record->total_marks;?>" name="std_total_marks"> 
                    <?php  else: ?>
                            <input type="text" class="form-control" value="<?php echo $student_record->total_marks;?>" name="std_total_marks" readonly="readonly"> 
                    <?php  endif; ?>
                    
                    
                    
                    <input type="hidden" class="form-control" name="serial_no" value="<?php echo $student_record->serial_no;?>" > 
              </div>    
            <div class="form-group col-md-3">
                    <label for="usr">Obtained Marks:</label>
                    
                    
                     <?php if($student_record->batch_id == '81'):?>
                            <input type="text" class="form-control" value="<?php echo $student_record->obtained_marks;?>" name="std_obtained_marks"> 
                    <?php  else: ?>
                            <input type="text" class="form-control" value="<?php echo $student_record->obtained_marks;?>" name="std_obtained_marks" readonly="readonly"> 
                    <?php  endif; ?>
                    
                    
              </div>
            <div class="form-group col-md-3">
                    <label for="usr">Grade:</label>
                    <?php
                            echo form_dropdown('std_grade_id', $grade,$grade_id,  'class="form-control"');
                    ?>
            </div>
                <div class="form-group col-md-3">
                    <label for="usr">Character:</label>
                     <?php
                            echo form_dropdown('std_char_id', $character,$char_id,  'class="form-control"');
                    ?>
                     
              </div>    
            <div class="form-group col-md-3">
                    <label for="usr">Admission Date <small>(DD-MM-YYYY)</small>:</label>
                    <?php
                $date = $result->admission_date;
                if($date === '0000-00-00' || $date == '1970-01-01'){
                    $date = '';
                    } else {
                    $date = date("d-m-Y", strtotime($date));
                    }
            ?>
            <input type="text" name="admission_date" value="<?php echo $date;?>" class="form-control date_format_d_m_yy"> 
              </div>
                <div class="form-group col-md-3">
                    <label for="usr">Certificate Issue Date <small>(DD-MM-YYYY)</small>:</label>
                    <?php
                $date_issue = $result->certificate_issue_date;
                if($date_issue === '0000-00-00' || $date_issue == '1970-01-01'){
                    $date_issue = '';
                    } else {
                    $date_issue = date("d-m-Y", strtotime($date_issue));
                    }
            ?>
                    <input type="text" class="form-control date_format_d_m_yy" value="<?php echo $date_issue;?>" name="certificate_issue_date" > 
              </div>
             <div class="form-group col-md-3">
                    <label for="usr">Dues if Any:</label>
                    <input type="number" class="form-control" name="dues_any" value="<?php echo $result->dues_any;?>"> 
              </div>
              <div class="form-group col-md-6">
                    <label for="usr">Remarks 1:</label>
                    <textarea type="text" class="form-control notes" rows="5" name="remarks"><?php echo $result->remarks;?></textarea>
              </div>
              <div class="form-group col-md-3">
                    <label for="usr">Remarks 2:</label>
                    <textarea type="text" class="form-control notes" rows="5" name="remarks2"><?php echo $result->remarks2;?></textarea> 
              </div>    
              </div>
              
             
              <!--//form-group-->
               
            </div>
        
        
          <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line"><?php echo $page_header?> Panel</span>
                        </h1>
                        <div class="section-content" >
                            
                                <div class="row">
                                  
                                          
                                <div class="col-md-3">
                                    <label for="name">Program</label>
                                    <div class="form-group ">
                                        <?php 
                                            echo form_dropdown('programe_id', $program,'',  'class="form-control " id="feeProgrameId" required="required"');
                                        ?>
                                    </div>
                                </div>
                         
                                <div class="col-md-3">
                                    <label for="name">Sub Program</label>
                                    <input type="hidden" value="<?php echo $student_id;?>" id="student_id" name="student_id">
                                    <div class="form-group ">
                                        <?php 
//                                        $sub_program = array('Sub Program'=>"Sub Program");
                                                echo form_dropdown('sub_programId', $sub_program,'',  'class="form-control sub_programId" id="showFeeSubPro"');
                                        ?>
                                    </div>
                                </div> 
                                <div class="col-md-3">
                                    <label for="name">Roll No</label>
                                    <div class="form-group ">
                                        <input type="text" id="rollno" placeholder="Roll No" class="form-control">
                                    </div>
                                </div> 
                                    <div class="col-md-3">
                                    <label for="name">Year Of Passing</label>
                                    
                                     <?php 
//                                        $sub_program = array('Sub Program'=>"Sub Program");
                                                echo form_dropdown('year_of_passing', $year_of_passing,'',  'class="form-control" id="year_of_passing"');
                                        ?>
                                    
                                </div>
                                
                            </div>
                            <div class="row">
                                 
                                <div class="col-md-3">
                                    <label for="name">Total Marks</label>
                                    <?php 
                                     
                                            echo form_dropdown('total_marks', $totalMarks,'',  'class="form-control" id="total_marks"');
                                    ?>
                                      
                                </div> 
                                <div class="col-md-3">
                                    <label for="name">Obtained Marks</label>
                                    <input type="number" id="obtained_marks" placeholder="Obtained Marks" class="form-control">
                                </div> 
                                <div class="form-group col-md-3">
                                        <label for="usr">Grade:</label>
                                        <?php
                                                echo form_dropdown('grade_id', $grade,'',  'class="form-control" id="grade_id"');
                                        ?>
                                </div>
                            </div>
                             
                              
                           </div><!--//section-content-->
                                     
                                 
                            <div style="padding-top:1%;">
                                <div class="col-md-4 pull-right">
                                    <button type="button" class="btn btn-theme" name="submitAc" id="GreenFileAdd"  value="Add Record" ><i class="fa fa-plus"></i>Add Record</button>
                                    <input type="submit" class="btn btn-theme" name="submit" value="Update Green File">
                                  </div>
                            </div>
                                    
                   </section>

          
            <div id="acdemicResult">
            </div>
    </form>            
                           
        </div>
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
      <div class="modal fade" id="updateGreenFile" tabindex="-1" role="dialog" aria-labelledby="Update Green File">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Update Banner Details</h4>
      </div>
        
        <div id="show_greenfile_std_education">
            
        </div>
      
    </div>
  </div>
</div>   
        
        <script>
        jQuery(document).ready(function(){
            jQuery("#GreenFileAdd").on('click',function(){
               
//       jQuery('#acdemicResult2').hide();
        var  student_id = jQuery('#student_id').val();
        var  sub_programId = jQuery('.sub_programId').val();
       if(sub_programId == '')
            {
               alert('Please select Prorgram name ');
               jQuery('#sub_pro_program').focus();
               return false;
            }
       
       var  rollno = jQuery('#rollno').val();
       
       if(rollno == '')
            {
               alert('Please select Roll No');
               jQuery('#rollno').focus();
               return false;
            }
       
       var  year_of_passing = jQuery('#year_of_passing').val();
       if(year_of_passing == '')
            {
               alert('Please Enter Passing Year');
               jQuery('#year_of_passing').focus();
               return false;
            }
       
       var  total_marks = parseInt(jQuery('#total_marks').val());
       if(total_marks == '')
            {
               alert('Please Enter Total Marks');
               jQuery('#total_marks').focus();
               return false;
            }
       
       var  obtained_marks = parseInt(jQuery('#obtained_marks').val());
       if(obtained_marks == null)
            {
               alert('Please Enter Obtained Marks');
               jQuery('#obtained_marks').focus();
               return false;
            }
       
       
       if(obtained_marks>total_marks){
           alert('Obtained Marks is Not Grater then Total Marks');
               jQuery('#obtained_marks').val('');
               jQuery('#obtained_marks').focus();
               return false;
       }
       
       if(obtained_marks<0){
           alert('Obtained Marks is Not Less then Zero');
               jQuery('#obtained_marks').val('');
               jQuery('#obtained_marks').focus();
               return false;
       }
       
       var  grade_id = jQuery('#grade_id').val();

       
     jQuery.ajax({
       type : "POST",
       url  : "GreenFileUpdateEdu",
       data :  {
         'student_id'       : student_id,
         'sub_pro_id'       : sub_programId,
         'rollno'           : rollno,
         'year_of_passing'  : year_of_passing,
         'total_marks'      : total_marks,
         'obtained_marks'   : obtained_marks,
         'grade_id'         : grade_id
     },
       success: function(result){
                jQuery('#rollno').val('');
                jQuery('.sub_programId').val('');
                jQuery('#year_of_passing').val('');
                jQuery('#total_marks').val('');
                jQuery('#obtained_marks').val('');
                jQuery('#grade_id').val('');
                
                jQuery.ajax({
                    type     : "POST",
                    url      : "GreenFileShowEdu",
                    data     :  {'student_id'   : jQuery('#student_id').val()},
                    success  : function(result){
                    jQuery('#acdemicResult').html(result);
                    }
                  });
           
       }
     });

  });
           

    jQuery.ajax({
       type     : "POST",
       url      : "GreenFileShowEdu",
       data     :  {'student_id'   : jQuery('#student_id').val()},
       success  : function(result){
//           alert('test');
        jQuery('#acdemicResult').html(result);
       }
     });
     });
        
        </script>     