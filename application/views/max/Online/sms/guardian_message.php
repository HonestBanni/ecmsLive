<style>
    input[type=checkbox]{
    zoom: 1.8;
    }
</style> 
<!-- ******CONTENT****** --> 
<div class="content container">
    <div class="page-wrapper">
        <header class="page-heading clearfix">
            <h1 class="heading-title pull-left"><?php echo $page_header?></h1>
                <div class="breadcrumbs pull-right">
                    <ul class="breadcrumbs-list">
                        <li class="breadcrumbs-label">You are here:</li>
                        <li><?php echo anchor('admin/admin_home', 'Home');?> 
                          <i class="fa fa-angle-right">
                          </i>
                        </li>
                        <li class="current"><?php echo $page_header?></li>
                    </ul>
                </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
     <div class="row">
          <div class="col-md-12">
                   <?php echo form_open('',array('class'=>'course-finder-form','id'=>'print_wise_form'));   ?>
              <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line"><?php echo $page_header?> Panel</span>
                        </h1>
                        <div class="section-content" >
                      
                                <div class="row">
                                <div class="col-md-2 col-sm-5">
                                      <label for="name">Form #</label>

                                       <div class="input-group" id="adv-search">
                                            <?php
                                                echo  form_input(
                                                         array(
                                                            'name'          => 'form_no',
                                                            'type'          => 'text',
                                                            'value'         => $form_no,
                                                            'class'         => 'form-control',
                                                            'placeholder'   => 'Form No #',
                                                             )
                                                         );
                                                  ?>
                                          </div>

                                 </div>
                                 
                                <div class="col-md-2 col-sm-5">
                                          <label for="name">College #</label>
                                        
                                           <div class="input-group" id="adv-search">
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'collegeNo',
                                                                'type'          => 'number',
                                                                'value'         => $college_no,
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'College #',
                                                                 )
                                                             );
                                                      ?>
                                              </div>
                                            
                                     </div>
                                
                                <div class="col-md-2 col-sm-5">
                                          <label for="name">Name</label>
                                        
                                           <div class="input-group" id="adv-search">
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'stdName',
                                                                'type'          => 'text',
                                                                'value'         => $stdName,
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'Student Name',
                                                                 )
                                                             );
                                                      ?>
                                              </div>
                                            
                                     </div>
                                     <input type="hidden" name="formCode" id="formCode" value="<?php $rand = rand(1,10000000); $date = date('YmdHis'); echo md5($rand.$date);?>">
                                     <input type="hidden" name="smsPassword" id="smsPassword" value="<?php echo $smsPassword;?>">
                                <div class="col-md-2 col-sm-5">
                                          <label for="name">Father Name</label>
                                        
                                           <div class="input-group" id="adv-search">
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'fatherName',
                                                                'type'          => 'text',
                                                                'value'         => $fatherName,
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'Father Name',
                                                                 )
                                                             );
                                                      ?>
                                              </div>
                                            
                                     </div>
                                    <div class="col-md-2">
                                    <label for="name">Gender</label>
                                    <div class="form-group ">
                                        <?php 
//                                        $Section = array('Section'=>"Section");
                                                echo form_dropdown('gender', $gender,$gender_id,  'class="form-control" ');
                                        ?>
                                    </div>
                                    </div> 
                                    <div class="col-md-2">
                                    <label for="name">Shift</label>
                                    <div class="form-group ">
                                        <?php 
//                                        $Section = array('Section'=>"Section");
                                                echo form_dropdown('shift', $shift,$shift_id,  'class="form-control" ');
                                        ?>
                                    </div>
                                    </div> 
                                        </div>
                            <div class="row">   
                                <div class="col-md-2">
                                    <label for="name">Program</label>
                                    <div class="form-group ">
                                        <?php 
                                            echo form_dropdown('programe_id', $program,$programe_id,  'class="form-control" id="Programe"');
                                        ?>
                                    </div>
                                </div>
                                
                         
                                <div class="col-md-2">
                                    <label for="name">Sub Program</label>
                                    <div class="form-group ">
                                        <?php 
//                                        $sub_program = array('Sub Program'=>"Sub Program");
                                                echo form_dropdown('sub_pro_id', $sub_program,$sub_pro_id,  'class="form-control" id="SubProgram"');
                                        ?>
                                    </div>
                                </div> 
                                <div class="col-md-2">
                                    <label for="name">Batch</label>
                                    <div class="form-group ">
                                        <?php 
                                            echo form_dropdown('batch', $batch,$batch_id,  'class="form-control" id="batch_id"');
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="name">Section</label>
                                    <div class="form-group ">
                                        <?php 
//                                        $Section = array('Section'=>"Section");
                                                echo form_dropdown('section', $section,$sec_id,  'class="form-control" id="Sections"');
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="name">Student Status</label>
                                    <div class="form-group ">
                                        <?php 
//                                        $Section = array('Section'=>"Section");
                                                echo form_dropdown('student_status', $student_status,$status_id,  'class="form-control" ');
                                        ?>
                                    </div>
                                </div> 
                                <div class="col-md-2">
                                    <label for="name">Picture</label>
                                    <div class="form-group ">
                                          <?php 
                                                $limit = array(
                                                  '2'=>'Picture Status',
                                                  '1'=>'Have Picture',
                                                  '0'=>'No Picture'
                                                  );
                                              echo  form_dropdown('picture',$limit,$pictureId,  'class="form-control" ');
                                              ?>
                                    </div>
                                </div>
                                 <div class="col-md-2 col-sm-5">
                                          <label for="name">Student No From 9th</label>
                                        
                                           <div class="input-group" id="adv-search">
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'std_no_from_9th',
                                                                'type'          => 'text',
                                                                'value'         => $std_no_from_9th,
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'Student No From 9th',
                                                                 )
                                                             );
                                                      ?>
                                              </div>
                                            
                                     </div>
                                 <div class="col-md-2 col-sm-5">
                                          <label for="name">Student No to 9th</label>
                                        
                                           <div class="input-group" id="adv-search">
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'std_no_to_9th',
                                                                'type'          => 'text',
                                                                'value'         => $std_no_to_9th,
                                                                'class'         => 'form-control',
                                                                'require'       => 'require',
                                                                'placeholder'   => 'Student No To 9th',
                                                                 )
                                                             );
                                                      ?>
                                              </div>
                                            
                                     </div>
                                 <div class="col-md-2 col-sm-5">
                                          <label for="name">Student No From 10th</label>
                                        
                                           <div class="input-group" id="adv-search">
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'std_no_from',
                                                                'type'          => 'text',
                                                                'value'         => $std_no_from,
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'Student Numbers From',
                                                                 )
                                                             );
                                                      ?>
                                              </div>
                                            
                                     </div>
                                 <div class="col-md-2 col-sm-5">
                                          <label for="name">Student No to 10th</label>
                                        
                                           <div class="input-group" id="adv-search">
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'std_no_to',
                                                                'type'          => 'text',
                                                                'value'         => $std_no_to,
                                                                'class'         => 'form-control',
                                                                'require'       => 'require',
                                                                'placeholder'   => 'Student Numbers To',
                                                                 )
                                                             );
                                                      ?>
                                              </div>
                                            
                                     </div>
                                
                                        <div class="col-md-2 col-sm-5">
                                            <label for="name">Entry Date From</label>
                                            <div class="input-group" id="adv-search">
                                                <?php echo  form_input(array(
                                                                        'name'          => 'entry_date_from',
                                                                        'type'          => 'text',
                                                                        'value'         => $entry_date_from,
                                                                        'class'         => 'form-control datepicker',
                                                                        'placeholder'   => 'Entry Date From',));
                                                      ?>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-sm-5">
                                            <label for="name">Entry Date To</label>
                                            <div class="input-group" id="adv-search">
                                                <?php echo  form_input(array(
                                                                        'name'          => 'entry_date_to',
                                                                        'type'          => 'text',
                                                                        'required'      => 'required',  
                                                                        'value'         => $entry_date_to,
                                                                        'class'         => 'form-control datepicker',
                                                                        'placeholder'   => 'Entry Date To',));
                                                      ?>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-sm-5">
                                            <label for="name">Hostel Apply</label>
                                                
                                                    <?php
                                                            $hostel = array(
                                                            '0'=>' Hostel Apply ',
                                                            '1'=>'Yes',
                                                            '2'=>'No'
                                                            );
                                                    echo  form_dropdown('hostel_req',$hostel,$hostelIdReq,  'class="form-control" id="my_id"');
                                                    ?>
                                            
                                            </div>
                                            <div class="col-md-2 col-sm-5">
                                            <label for="name">Hostel Status</label>
                                                
                                                    <?php
                                                         
                                                    echo  form_dropdown('hostel_status',$hostel_status,$hostel_status_id,  'class="form-control"');
                                                    ?>
                                            
                                            </div>
                                        <div class="col-md-2">
                                            <label for="name">Verify Marks</label>
                                            <div class="form-group ">
                                                <?php 
                                                    $VerifyMarks = array(
                                                      ''    => "Select Verify Marks",  
                                                      '2'    => "Yes",  
                                                      '1'    => "No",  
                                                    );
                                                    echo form_dropdown('verify_marks', $VerifyMarks,$verify_marks_id,  'class="form-control"');
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="name">Challan Upload</label>
                                            <div class="form-group ">
                                                <?php 
                                                    echo form_dropdown('upload_challan', $ChallanUpload,$challan_up_id,  'class="form-control"');
                                                ?>
                                            </div>
                                        </div>
                                
<!--                                <div class="col-md-2">
                                    <label for="name">DMC Upload</label>
                                    <div class="form-group ">
                                        <?php 
                                            echo form_dropdown('upload_dmc', $DMCUpload,$dmc_up_id,  'class="form-control"');
                                        ?>
                                    </div>
                                </div>-->
                                </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                          <label for="name">Message</label>
                                        
                                           <div class="input-group" id="adv-search">
                                                <?php
                                                     echo form_textarea(
                                                             array(
                                                                'name'          => 'message',
                                                                'id'            => 'message',
                                                                'value'         => $message,
                                                                'type'          => 'text',
                                                                'cols'          => '150',
                                                                'rows'          => '3',
                                                                 
                                                             
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'Type Message',
                                                                
                                                                 )
                                                             );
                                                      ?>
                                              </div>
                                          <p><span id="remaining">160 characters remaining</span> <span id="messages">1 message(s)</span></p>                                           
                                     </div>
                                 
                            </div>
                              
                           </div><!--//section-content-->
                                     
                                 
                          <div style="padding-top:1%;">
                                <div class="col-md-3 pull-right">
                                    
                                    <button type="submit" class="btn btn-theme" name="search" id="search"  value="search" ><i class="fa fa-search"></i> Search</button>
                                    <button type="submit" class="btn btn-theme" name="sendSMS" id="sendSMS"  value="sendSMS" ><i class="fa fa-search"></i> Send SMS</button>
                                     
     
                                </div>
                            </div>
                                 
                                
                           
                            
                        
                        
                        
                    </section>
              <?php
               
                        if($this->session->flashdata('error_return')):
                              foreach($this->session->flashdata('error_return') as $row=>$key):
                                echo '<div class="alert alert-danger alert-dismissable center">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">??</button>
                                    <strong>'.$key.'</strong> </div>';
                             endforeach;
                         endif; 
                        if($this->session->flashdata('success_return')):
                               
                                echo '<div class="alert alert-success alert-dismissable center">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">??</button>
                                    <strong>'.$this->session->flashdata('success_return').'</strong> </div>';
                            
                         endif; 
                           
                   if(!empty($result)):   
            
        echo '<div class="row">
              <div class="col-md-12 ">';
                                        
                        
                                echo '<div id="div_print">
                                        <h3 class="has-divider text-highlight">Result :'; echo count($result); 
                                        echo '</h3>
                                        <div class="table-responsive">
                                              <table class="table table-hover" id="table" style="font-size:11px;">
                                                    <thead>
                                                      <tr>

                                                            <th>#</th>
                                                            <th><input type="checkbox" id="checkAll" checked="checked"></th> 
                                                            
                                                            <th>College#</th>
                                                            <th>Form No</th>
                                                            <th>Student Name</th>
                                                            <th>Father Name</th>
                                                            <th>Guardian</th>
                                                            <th>Degree</th>
                                                            <th>Marks 9th</th>
                                                            <th>Marks 10th</th>
                                                            <th>%age</th>
                                                            <th>Entry Date</th>
                                                            <th>Challan Up</th>
                                                            <th>DMC Up</th>
                                                            <th>Verify Marks</th>
                                                           
                                                          

                                                      </tr>
                                                    </thead>
                                                    <tbody>';
  
                                                        $sn = "";
                                                          foreach($result as $row):
                                                              
                                                            $sn++;  
                                                              echo ' <tr>
                                                                  <td>'.$sn.'</td>
                                                                <td><input type="checkbox" name="checked[]" value="'.$row->student_id.'"   id="checkItem" checked="checked">
                                                                    <input type="hidden"      id="student_id" >
                                                                 </td>';
                                                                
                                                                echo '<td>'.$row->college_no.'</td>';
                                                                echo '<td>'.$row->form_no.'</td>';
                                                                echo '<td>'.substr($row->student_name, 0, 30).' </td>';
                                                                echo '<td>'.substr($row->father_name, 0, 30).' </td>';
                                                                  
                                                                echo '<td>'.$row->mobile_no.'</td>';     
                                                                echo '<td>'.$row->DegreeTitle.'</td>';     
                                                                echo '<td>'.$row->obtained_marks_9th.'/'.$row->total_marks_9th.'</td>';     
                                                                echo '<td>'.$row->obtained_marks.'/'.$row->total_marks.'</td>';     
                                                                echo '<td>'.$row->percentage.'</td>';      
                                                                echo '<td>'.date('d-m-Y H:i:s',strtotime($row->timestamp)).'</td>'; 
                                                                
                                                                
                                                                $challan_paid_flag = $this->db->get_where('student_documents',array('sd_student_id'=>$row->student_id,'sd_flag'=>1))->row(); 
                                                                $challanPaidFlag = 'No';
                                                                if(!empty($challan_paid_flag)):
                                                                    $challanPaidFlag = '<strong>Yes</strong>';
                                                                endif;
                                                                $DMCFlag    = $this->db->get_where('student_documents',array('sd_student_id'=>$row->student_id,'sd_flag'=>2))->row(); 
                                                                $DMC_Flag = 'No';
                                                                if(!empty($DMCFlag)):
                                                                    $DMC_Flag = '<strong>Yes</strong>';
                                                                endif;
                                                                
                                                                
                                                                 echo '<td>'.$challanPaidFlag.'</td>'; 
                                                                 echo '<td>'.$DMC_Flag.'</td>'; 
                                                                 if($row->app_verify_flag == 1):
                                                                      echo '<td>No</td>'; 
                                                                     else:
                                                                     echo '<td><strong>Yes</strong></td>'; 
                                                                 endif;
                                                                
                                                                
                                                                
                                                                echo '  </tr>';
                                                         
                                                          endforeach;      
                                               

                                                    echo'</tbody>
                                            </table>
                                        </div>';
                                          
                                 
                                    
                                    echo '</div>
                                    </div>
                                  
                                </div>';
                                    else:
                                        
                                    echo '<div class="row">
                                            <div class="col-md-12 ">
                                            <h2>Result not found</h2>
                                            </div>
                                  </div>';  
                                  endif;
                             
                             ?>
                            <?php
                                    echo form_close();
                                    ?>         
                                </div>
 
          </div>
          
      
      </div>
                 </div>
                
    
      
        <!--//page-row-->
      </div>
 
    <!--//page-wrapper--> 
 
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

           
        
        
        
     
   
   
    jQuery('#sendSMS').on('click',function(){
        jQuery('#sendSMS').hide();
    });
   
   });
    </script>

  <script>
    var $remaining = $('#remaining'),
    $messages = $remaining.next();

$('#message').keyup(function(){
    var chk_msg = jQuery(this).val();
    var msg = chk_msg.includes("'");
    if(msg){
       alert('Please remove special character....');
        jQuery('#sendSMS').hide();
    }else{
        jQuery('#sendSMS').show();
    }
    
    var chars = this.value.length,
        messages = Math.ceil(chars / 160),
        remaining = messages * 160 - (chars % (messages * 160) || messages * 160);

    $remaining.text(remaining + ' characters remaining');
    $messages.text(messages + ' message(s)');
});
    </script>


     <script>
  $( function() {
      
      
    $( ".datepicker" ).datepicker({
        numberOfMonths: 1,
        dateFormat: 'dd-mm-yy'
 
    });
  } );
  </script>
  <style>
      .datepicker{
          z-index: 1;
      }
  </style>     
  
 
  
  
   