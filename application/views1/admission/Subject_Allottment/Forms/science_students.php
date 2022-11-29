        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left"><?php echo $page_header?><hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    <?php echo form_open('',array('class'=>'course-finder-form','id'=>'print_wise_form'));?>
                    <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line"><?php echo $page_header?> Panel</span>
                        </h1>
                        <div class="section-content" >
                           
                                <div class="row">
                                     <input type="hidden" name="formCode" id="formCode" value="<?php $rand = rand(1,10000000); $date = date('YmdHis'); echo md5($rand.$date);?>">
<!--                                <div class="col-md-2 col-sm-5">
                                          <label for="name">College #</label>
                                        <input type="hidden" name="formCode" id="formCode" value="<?php $rand = rand(1,10000000); $date = date('YmdHis'); echo md5($rand.$date);?>">
                                           <div class="input-group" id="adv-search">
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
                                            
                                     </div>-->
                                
<!--                                <div class="col-md-2 col-sm-5">
                                          <label for="name">Name</label>
                                        
                                           <div class="input-group" id="adv-search">
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
                                            
                                     </div>-->
<!--                                <div class="col-md-2 col-sm-5">
                                          <label for="name">Father Name</label>
                                        
                                           <div class="input-group" id="adv-search">
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
                                            
                                     </div>-->
                                  
                         
                                <div class="col-md-3">
                                    <label for="name">Sub Program</label>
                                    <div class="form-group ">
                                        <?php 
//                                        $sub_program = array('Sub Program'=>"Sub Program");
                                                echo form_dropdown('sub_pro_id', $sub_program,$sub_pro_id,  'class="form-control" id="sub_proId" required="required"');
                                                
                                        ?>
                                    </div>
                                </div> 
                                <div class="col-md-3">
                                    <label for="name">Section</label>
                                    <div class="form-group ">
                                        <?php 
                                            echo form_dropdown('session_id',$section,$section_id,  'class="form-control" id="showSession"');
                                        ?>
                                    </div>
                                </div> 
                            </div>
                             
                              
                        </div><!--//section-content-->
                                     
                                 
                        <div style="padding-top:1%;">
                            <div class="col-md-3">
                                    <button type="button" class="btn btn-success" >Total Students :<?php echo $count?></button>
                                      
                            </div>
                            <div class="col-md-5 col-sm-5">
                                          
                                                <?php
                                                if(@$searchResult):
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'subject_name',
                                                                'id'            => 'subject_name',
                                                                'type'          => 'text',
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'Select Subjects',
                                                                 )
                                                             );
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'subject_id',
                                                                'id'            => 'subject_id',
                                                                'type'          => 'hidden',
                                                                'class'         => 'form-control',
                                                                
                                                                 )
                                                             );
                                                endif;
                                                    
                                                      ?>
                                            
                                            
                                     </div>

                            <div class="col-md-4 pull-right">
                                <?php
                                if(@$searchResult):
                                    echo '<button type="button" class="btn btn-theme" name="add_subject" id="add_subject"  value="add_subject" ><i class="fa fa-plus"></i> Add Subject</button>&nbsp;';
                                    echo '<button type="submit" class="btn btn-theme" name="save_record" id="save_record"  value="save_record" ><i class="fa fa-book"></i> Save</button>';
                                endif;
                                
                                ?>
                                
                                <button type="submit" class="btn btn-theme" name="search" id="search"  value="search" ><i class="fa fa-search"></i> Search</button>
                            </div>
                        </div>
                           
                                    
                        </section>
                    <div class="col-md-10 col-md-offset-1">
                        <div class="table-responsive">
                             <div id="alloted_subject_show">
                        
                            </div>
                        </div>
                    </div>
                   
                    
                    <div class="col-md-12">
                         <div class="table-responsive">
              
              <?php
              if($this->session->flashdata('subject_msg')):
                  
                 foreach($this->session->flashdata('subject_msg') as $row=>$value):
                  
                
              
              ?>
              <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <?php
                echo $value;
//               echo '<pre>'; print_r($this->session->flashdata('subject_msg'));
                
                ?>
            </div>
              <?php
               endforeach;
                endif;
                ?>
            <table class="table table-hover table-boxed" id="table">
                <?php 
                
                 if(@$searchResult):
                     ?>
               <thead>
                        <tr>
                                                        <th>#</th>
                            <th><input type="checkbox" id="checkAll" style="zoom: 1.5;"></th>
                            <th>Picture</th>

                            <th>College#</th>
                            <th>Student name</th>
                            <th>Father name</th>
                            <th>Sub Program</th>
                            <th>Section</th>
                  
                        </tr>
                    </thead>  
                    <tbody>
                <?php
                
               $sn = '';
                    foreach($searchResult as $StdRow):
                    
                 $sn++;
                ?>
                    <tr class="gradeA">
                             <td><?php echo $sn;?></td>
                            <td>
                                <input type="checkbox" name="checked[]" value="<?php echo $StdRow->student_id?>" style="zoom: 1.5;" id="checkItem">
                                <input type="hidden" name="student_id">
                                </td>
                                <td><?php 
                                
                                if($StdRow->applicant_image):
                                    echo ' <img src="assets/images/students/'.$StdRow->applicant_image.'" width="60" height="60">';
                                    else:
                                       echo ' <img src="assets/images/students/user.png" width="60" height="60">';
                                endif;
                
                                
                                
                                ?>
                                   
                                </td>       
                            <td><?php echo $StdRow->college_no;?></td>
                            <td><?php echo $StdRow->student_name;?></td>
                            <td><?php echo $StdRow->father_name;?></td>
                            <td><?php echo $StdRow->sub_program;?></td>
                            <td><?php echo $StdRow->sections_name;?></td>
                          
                     </tr>
                 <?php
                    
                    endforeach;
                    endif;
                    ?>
                </tbody>
            </table> 
            </div>
                    </div>  
                    
               
                    
                     <?php echo form_close();?>
                     
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
        
        
        <script>
       jQuery(document).ready(function(){
           jQuery('#add_subject').on('click',function(){
               jQuery('#sub_proId').removeAttr('disabled');
               var subject_id = jQuery('#subject_id').val();
               var form_code = jQuery('#formCode').val();
               var sub_proId = jQuery('#sub_proId').val();
                
               
               if(subject_id == ''){
                   alert('Please Select Subject First...');
                   jQuery('#subject_name').focus();
                   jQuery('#subject_name').val('');
                   return false;
               };
               jQuery.ajax({
                   type : 'post',
                   url  : 'GroupAllotedDemo_js',
                   data :   {'form_code':form_code,'subject_id':subject_id,'sub_proId':sub_proId},
                   success: function(result){
                       
                       
                       jQuery('#sub_proId').attr('disabled', 'disabled');
                       jQuery('#alloted_subject_show').html(result);
                       
                   }
               });
               
           });
           jQuery('#save_record').on('click',function(){
               
               jQuery('#sub_proId').removeAttr('disabled');
                
               
               
           });
           
        jQuery("#subject_name").autocomplete({  
            minLength: 0,
            source: "ShowSubjectAllottment/"+$("#subject_name").val(),
            autoFocus: true,
            scroll: true,
            dataType: 'jsonp',
            select: function(event, ui){
            jQuery("#subject_name").val(ui.item.contactPerson);
            jQuery("#subject_id").val(ui.item.code);
           
            }
            }).focus(function() {  jQuery(this).autocomplete("search", "");  });
        
   });     
        </script>