        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left"><?php echo $ReportName?><hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line"><?php echo $ReportName?> Search Panel</span>
                        </h1>
                        <div class="section-content" >
                           <?php echo form_open('',array('class'=>'course-finder-form','id'=>'print_wise_form')); ?>
                                <div class="row">
                                    <div class="col-md-3">
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
 
                                    <div class="col-md-3">
                                        <label for="name">College #</label>
                                        <?php
                                            echo  form_input(
                                                array(
                                                'name'          => 'college_no',
                                                'type'          => 'number',
                                                'value'         => $college_no,
                                                'class'         => 'form-control',
                                                'placeholder'   => 'College #',
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
                                    <div class="col-md-3">
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
                                            <?php  echo form_dropdown('gender', $gender,$gender_id,  'class="form-control" '); ?>
                                        </div>
                                    </div> 
                                          
                                    <div class="col-md-3">
                                        <label for="name">Program</label>
                                        <div class="form-group ">
                                            <?php echo form_dropdown('programe_id', $program,$programe_id,  'class="form-control" id="Programe"'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="name">Batch</label>
                                        <div class="form-group ">
                                            <?php echo form_dropdown('batch', $batch,$batch_id,  'class="form-control" id="batch_id"'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="name">Sub Program</label>
                                        <div class="form-group ">
                                            <?php echo form_dropdown('sub_pro_id', $sub_program,$sub_pro_id,  'class="form-control" id="SubProgram"'); ?>
                                        </div>
                                    </div> 
                                    <div class="col-md-3">
                                        <label for="name">Status</label>
                                        <div class="form-group ">
                                            <?php echo form_dropdown('status_id', $student_status,$status_id,  'class="form-control"'); ?>
                                        </div>
                                    </div> 
                                     
                                     
                                </div>
                             
                              
                           </div><!--//section-content-->
                                     
                                 
                            <div style="padding-top:1%;">
                                
                             
                                <div class="col-md-2 pull-right">
                                    <button type="submit" class="btn btn-theme" name="filter" id="filter"  value="filter" ><i class="fa fa-search"></i> Search</button>
                                  </div>
                            </div>
                                    <?php
                                    echo form_close();
                                    ?>
                                
                             
                            
                        
                        
                        
                    </section>
                    
                    <div class="col-md-12">
                        
                    </div>
                    <?php
                        if(!empty($result)):
                            
                        
                        ?>
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-boxed table-bordered table-striped" width="100%" style="font-size:12px;">
                    <thead>
                        <tr>
                            <th style="vertical-align: text-bottom;">SN</th>
                            <th style="vertical-align: text-bottom;">Form #</th>
                            <th style="vertical-align: text-bottom;">College #</th>
                            <th style="vertical-align: text-bottom;">Student Name</th>
                            <th style="vertical-align: text-bottom;">Father Name</th>
                            <th style="vertical-align: text-bottom;">Batch</th>
                            <th style="vertical-align: text-bottom;">Program</th>
                            <th style="vertical-align: text-bottom;">Sub Program</th>
                            <th style="vertical-align: text-bottom;">Status</th>
                            <th style="vertical-align: text-bottom;"><i class="icon-edit" style="color:#fff"></i><b> </b></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                       
                            
                        
                        $sn= '';    
                        foreach($result as $rec):
                            $sn++;
                                echo '<tr class="gradeA Student'.$rec->student_id.'" >';
                                echo '<td><i>'.$sn.'</i></td>';
                                echo '<td>'.$rec->form_no.'</td>';
                                echo '<td>'.$rec->college_no.'</td>';
                                echo '<td>
                                    <a href="javascript:void(0);" class="applicantProfile" data-toggle="modal" data-target="#StudentProfilePopUp"  id="'.$rec->student_id.'">
                                        <strong>'.wordwrap($rec->student_name, 20, "\n", true).'</strong>
                                    </a>
                                </td>';
                                echo '<td>'.wordwrap($rec->father_name, 20, "\n", true).'</td>';
                                echo '<td>'.$rec->batch.'</td>';
                                echo '<td>'.$rec->program_name.'</td>';
                                echo '<td>'.$rec->sub_program.'</td>';
                                echo '<td><span class="label label-success btn-sm">'.$rec->status.'</span></td>';
                                echo '<td><a href="" class="btn btn-success btn-sm challan_button" data-toggle="modal" data-target="#ChallanModal" id="'.$rec->student_id.'"><b>Change Date</b></a>
                               
                                 </tr>';    
                        endforeach;
                       
                     ?>
                        </tbody>
                </table>                
              <?php
               endif;
              ?>
                </div><!--//col-md-3-->
                
                <div class="modal fade" id="ChallanModal" role="dialog" style="z-index:9999">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="section-content" id="ChallanResult" >
                            </div>
                        </div>
                    </div>
                </div>
                 
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
        
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
 
 
    jQuery('.challan_button').on('click',function(){
        
        var student_id = jQuery(this).attr('id');
          jQuery.ajax({
               type   :'post',
               url    :'ProspectusChallanUpdateGet',
               data   :{'student_id':student_id},
              success :function(result){
//                 $('.Student'+student_id).hide(); 
                    jQuery('#ChallanResult').html(result);
              }
           });
    });

  });
 
  </script> 