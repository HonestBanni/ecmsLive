        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left"><?php echo $ReportName?>
                <span style="float:right"><a href="BSAdmissionForm" class="btn btn-large btn-primary">Add New Student</a></span>
                <hr>
            </h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line"><?php echo $ReportName?> Panel</span>
                        </h1>
                        <div class="section-content" >
                           <?php echo form_open('',array('class'=>'course-finder-form','id'=>'print_wise_form'));
                                  
                                     ?>
                                <div class="row">
                                <div class="col-md-3 col-sm-5">
                                          <label for="name">Form #</label>
                                         
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'Form',
                                                                'type'          => 'number',
                                                                'value'         => $Form,
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'Form #',
                                                                 )
                                                             );
                                                      ?>
                                         
                                            
                                     </div>
 
                                
                                <div class="col-md-3 col-sm-5">
                                          <label for="name">Name</label>
                                        
                                           
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'student_name',
                                                                'type'          => 'text',
                                                                'value'         => $stdName,
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'Student Name',
                                                                 )
                                                             );
                                                      ?>
                                           
                                            
                                     </div>
                                <div class="col-md-3 col-sm-5">
                                          <label for="name">Father Name</label>
                                         
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'father_name',
                                                                'type'          => 'text',
                                                                'value'         => $fatherName,
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'Father Name',
                                                                 )
                                                             );
                                                      ?>
                                              </div>
                                            
                                     
                                 
                                    <div class="col-md-3">
                                    <label for="name">Gender</label>
                                    <div class="form-group ">
                                        <?php 
//                                        $Section = array('Section'=>"Section");
                                                echo form_dropdown('gender', $gender,$gender_id,  'class="form-control" ');
                                        ?>
                                    </div>
                                </div> 
                                          
                                <div class="col-md-3">
                                    <label for="name">Program</label>
                                    <div class="form-group ">
                                        <?php 
                                            echo form_dropdown('programe_id', $program,$programe_id,  'class="form-control" id="Programe"');
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="name">Batch</label>
                                    <div class="form-group ">
                                        <?php 
                                            echo form_dropdown('batch', $batch,$batch_id,  'class="form-control" id="batch_id"');
                                        ?>
                                    </div>
                                </div>
                         
                                <div class="col-md-3">
                                    <label for="name">Sub Program</label>
                                    <div class="form-group ">
                                        <?php 
//                                        $sub_program = array('Sub Program'=>"Sub Program");
                                                echo form_dropdown('sub_pro_id', $sub_program,$sub_pro_id,  'class="form-control" id="SubProgram"');
                                        ?>
                                    </div>
                                </div> 
                                <div class="col-md-3">
                                    <label for="name">Status</label>
                                    <div class="form-group ">
                                        <?php 
//                                        $sub_program = array('Sub Program'=>"Sub Program");
                                                echo form_dropdown('status_id', $student_status,$status_id,  'class="form-control"');
                                        ?>
                                    </div>
                                </div> 
                                <div class="col-md-3">
                                    <label for="name">Fata Status</label>
                                    <div class="form-group ">
                                        <?php 
//                                        $sub_program = array('Sub Program'=>"Sub Program");
                                                echo form_dropdown('FataStatus', $FataStatus,$fata_id,  'class="form-control"');
                                        ?>
                                    </div>
                                </div> 
                                <div class="col-md-3">
                                    <label for="name">Hostel Status</label>
                                    <div class="form-group ">
                                        <?php 
//                                        $sub_program = array('Sub Program'=>"Sub Program");
                                                echo form_dropdown('hostelStatus', $hostel_required,$hostel_required_id,  'class="form-control"');
                                        ?>
                                    </div>
                                </div> 
                            </div>
                             
                              
                           </div><!--//section-content-->
                                     
                                 
                            <div style="padding-top:1%;">
                                <div class="col-md-2 pull-left">
                                    <button type="button" class="btn btn-success" >Search Students :<?php echo $count?></button>
                                  </div>
                             
                                <div class="col-md-2 pull-right">
                                    <button type="submit" class="btn btn-theme" name="filter" id="filter"  value="filter" ><i class="fa fa-search"></i> Search</button>
                                  </div>
                            </div>
                                    <?php
                                    echo form_close();
                                    ?>
                                
                             
                            
                        
                        
                        
                    </section>
                    
                    <div class="col-md-12">
                        <h4><?php  
                        
                        if(!empty($pagination_links)):
                            
                        echo    $pagination_links;
                            
                        endif;
                       ?></h4>
                    </div>
                    
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-boxed table-bordered table-striped" width="100%">
                    <thead>
                        <tr>
                            <th width="5" style="vertical-align: text-bottom;">SN</th>
                            <th width="50" style="vertical-align: text-bottom;">Picture</th>
                            <th width="80" style="vertical-align: text-bottom;">Student Name</th>
                            <th width="100" style="vertical-align: text-bottom;">F-Name</th>
                            <th width="60" style="vertical-align: text-bottom;">Form #</th>
                            <th width="110" style="vertical-align: text-bottom;">Sub Program</th>
                            <th width="60" style="vertical-align: text-bottom;">9th O/T Marks</th>
                            <th width="60" style="vertical-align: text-bottom;">10th O/T Marks</th>
                            <th width="110" style="vertical-align: text-bottom;">Fata Status</th>
                            <th width="110" style="vertical-align: text-bottom;">Hostel Status</th>
                            <th width="80" style="vertical-align: text-bottom;">Status</th>
                            <th width="80" style="vertical-align: text-bottom;">Downloads</th>
                            <!--<th width="80" style="vertical-align: text-bottom;">Data Verify </th>-->
                            <!--<th width="45" style="vertical-align: text-bottom;"><i class="icon-edit" style="color:#fff"></i><b> Update</b></th>-->
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sn= '';    
                        foreach($result as $rec):
                            $education_details = $this->CRUDModel->get_where_row('applicant_edu_detail',array('student_id'=>$rec->student_id));
                            $sn++;
                                echo '<tr class="gradeA Student'.$rec->student_id.'" >';
                                echo '<td><i>'.$sn.'</i></td>';
                            if($rec->applicant_image == ''):
                                echo '<td><img src="assets/images/new_students/user.png" width="50" height="40"></td>';
                            else:
                                echo '<td><img src="assets/images/new_students/'.$rec->applicant_image.'" width="50" height="40"></td>';
                            endif;
                                echo '<td>
                                    <a href="javascript:void(0);" class="applicantProfile" data-toggle="modal" data-target="#StudentProfilePopUp"  id="'.$rec->student_id.'">
                                        <strong>'.wordwrap($rec->student_name, 20, "\n", true).'</strong>
                                    </a>
                                </td>';
//                                echo '<td><a href="ApplicantProfile/'.$rec->student_id.'">'.$rec->student_name.'</a></td>';
                                echo '<td>'.wordwrap($rec->father_name, 20, "\n", true).'</td>';
                                echo '<td>'.$rec->form_no.'</td>';
                                echo '<td>'.$rec->sub_program.'</td>';
                            if(!empty($education_details)):
                                 echo '<td>'.$education_details->obtained_marks_9th.' / '.$education_details->total_marks_9th.'</td>';
                                 echo '<td>'.$education_details->obtained_marks.' / '.$education_details->total_marks.'</td>';
                            endif;
                                echo '<td>'.$rec->fata_school.'</td>';
                                echo '<td>'.$rec->hostel_required.'</td>';
                                echo '<td><span class="label label-success btn-sm">'.$rec->status.'</span></td>';
                                echo '<td><a href="AdmissionFormDownloadu/'.$rec->student_id.'" class="label label-danger btn-sm"><i class="fa fa-download"></i>Admission Form</a>';
                                
                                  $student_documents = $this->db->get_where('student_documents',array('sd_student_id'=>$rec->student_id,'sd_flag'=>2))->row();
                                if(!empty($student_documents)):
                                     echo '<a target="_new" href="assets/images/applicant_docs/'.$student_documents->sd_image.'" class="label label-success btn-sm"><i class="fa fa-download"></i>Student DMC</a><br/>';
                                echo '</td>';
                                else:
                                    echo '</td>';
                                endif;
                            
                                                    $this->db->join('users','users.id=data_verification_log.update_by');
                                                  $this->db->join('hr_emp_record','hr_emp_record.emp_id=users.user_empId');
                                  $check_verify = $this->db->get_where('data_verification_log',array('student_id'=>$rec->student_id))->row();
                              if(!empty($check_verify)):
                                    '<td>'.$check_verify->emp_name.'<br/>'.date('d-m-Y',strtotime($check_verify->update_datetime)).'</td>';
                                  else:
                                    '<td></td>';
                              endif;    
                                
                            if($rec->s_status_id == 16):
//                                echo '<td><a href="javascript:void(0)" class="btn btn-primary btn-sm DataVerified" data-toggle="modal" data-target="#dataVerificationPopUp"   id="'.$rec->student_id.'"><i class="fa fa-check"></i>  <b>Data Verified</b></a></td>';
                            else:
//                                echo '<td></td>';
                            endif;
                                echo '</tr>';    
                        endforeach;
                     ?>
                        </tbody>
                </table>                
                
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
        <div class="modal fade" id="dataVerificationPopUp" role="dialog" style="z-index:9999">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="section-content" id="dataVerificationResult" >
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="modal fade" id="StudentProfilePopUp" role="dialog" style="z-index:9999">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                                <br>
                            </div>
                            <div class="section-content" id="profileResult" >
                            </div>
                        </div>
                    </div>
                </div>
        <script>
  jQuery(document).ready(function(){

    jQuery('#Programe').on('click',function(){
    var programId = jQuery('#Programe').val();
    
       //get sub program
       jQuery.ajax({
        type   :'post',
        url    :'DDSubPrograms',
        data   :{'programId':programId},
        success :function(result){
           jQuery('#SubProgram').html(result);
       },
       complete:function(){
           //Get Batch 
           jQuery.ajax({
               type   :'post',
               url    :'DDBatch',
               data   :{'programId':programId},
              success :function(result){
                  console.log(result);
                 jQuery('#batch_id').html(result);
              }
           });
           
             
       }
       
    });
    
}); 
    jQuery('#SubProgram').on('change',function(){
   
   var sub_program_id   = jQuery('#SubProgram').val();
    var programId       = jQuery('#Programe').val();
    jQuery.ajax({
        type   :'post',
        url    :'DDSections',
        data   :{'sub_program_id':sub_program_id,'programId':programId},
       success :function(result){
           console.log(result);
          jQuery('#Sections').html(result);
       }
    });
}); 
    jQuery('.DataVerified').on('click',function(){
        
        var student_id = jQuery(this).prop('id');
        
          jQuery.ajax({
               type   :'post',
               url    :'DataVerfUpdate',
               data   :{'student_id':student_id},
              success :function(result){
                  jQuery('#dataVerificationResult').html(result);
                }
           });
    });
    jQuery('.applicantProfile').on('click',function(){
        
        var student_id = jQuery(this).prop('id');
   
          jQuery.ajax({
               type   :'post',
               url    :'ShowApplicantProfile',
               data   :{'std_id':student_id},
              success :function(result){
//                 $('.Student'+student_id).hide(); 
                    jQuery('#profileResult').html(result);
              }
           });
    });
    
  });
 
  </script>