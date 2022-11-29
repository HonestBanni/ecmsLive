        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left"><?php echo $ReportName?>
                <span style="float:right"><a href="admin/add_a_level_student" class="btn btn-large btn-primary">Add New Student</a></span>
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
                                          <label for="name">College#</label>
                                         
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'college_no',
                                                                'type'          => 'number',
                                                                'value'         => $collegeNo,
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'College #',
                                                                 )
                                                             );
                                                      ?>
                                         
                                            
                                     </div>
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
                                  
                            </div>
                             
                              
                           </div><!--//section-content-->
                                     
                                 
                            <div style="padding-top:1%;">
                                <div class="col-md-2 pull-left">
                                    <button type="button" class="btn btn-success" >Search Students :<?php echo $count?></button>
                                  </div>
                             
                                <div class="col-md-2 pull-right">
                                    <button type="submit" class="btn btn-theme" name="filter" id="filter"  value="filter" ><i class="fa fa-search"></i> Search</button>
                                    <input type="submit" name="export" class="btn btn-theme" value="export">
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
                    
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-boxed table-bordered table-striped" style="font-size:12px" width="100%">
                    <thead>
                        <tr>
                            <th width="5" style="vertical-align: text-bottom;">SN</th>
                            <th width="50" style="vertical-align: text-bottom;">Picture</th>
                            <th width="80" style="vertical-align: text-bottom;">Student Name</th>
                            <th width="100" style="vertical-align: text-bottom;">F-Name</th>
                            <th width="60" style="vertical-align: text-bottom;">Form #</th>
                            <th width="110" style="vertical-align: text-bottom;">Program</th>
                            <th width="110" style="vertical-align: text-bottom;">Sub Program</th>
                            <th width="110" style="vertical-align: text-bottom;">Batch</th>
                            <th width="110" style="vertical-align: text-bottom;">Section</th>
                            <th width="80" style="vertical-align: text-bottom;">Status</th>
                            <th width="45" style="vertical-align: text-bottom;"><i class="icon-edit" style="color:#fff"></i><b> Update</b></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sn= '';    
                        foreach($result as $rec):
//                            echo '<pre>';print_r($rec);die;
                            $sn++;
                                echo '<tr class="gradeA Student'.$rec->student_id.'" >';
                                echo '<td><i>'.$sn.'</i></td>';
                                $file_path = 'assets/images/students/'.$rec->applicant_image;
                                if(file_exists($file_path)):
                                    echo '<td><img src="'.$file_path.'" width="50" height="40"></td>';
                                else:
                                     echo '<td><img src="assets/images/students/user.png" width="50" height="40"></td>';
                                endif;
                                echo '<td>
                                    <a href="javascript:void(0);" class="applicantProfile" data-toggle="modal" data-target="#StudentProfilePopUp"  id="'.$rec->student_id.'">
                                        <strong>'.wordwrap($rec->student_name, 20, "\n", true).'</strong>
                                    </a>
                                </td>';
                                    
                                echo '<td>'.wordwrap($rec->father_name, 20, "\n", true).'</td>';
                                echo '<td>'.$rec->form_no.'</td>';
                                echo '<td>'.$rec->programe_name.'</td>';
                                echo '<td>'.$rec->sub_program.'</td>';
                                echo '<td>'.$rec->batch.'</td>';
                                echo '<td>'.$rec->section.'</td>';
                                echo '<td><span class="label label-success btn-sm">'.$rec->status.'</span></td>';
                                echo '<td><a class="btn btn-primary btn-sm" href="admin/update_student/'.$rec->student_id.'"><b>Edit</b></a></td>';
                                
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