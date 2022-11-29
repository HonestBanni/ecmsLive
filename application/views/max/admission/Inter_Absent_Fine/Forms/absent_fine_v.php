        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left"><?php echo $page_header?> <hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line"><?php echo $page_header?> Panel</span>
                            
                        </h1>
                        <div class="section-content" >
                           <?php echo form_open('',array('class'=>'course-finder-form'));
                                  
                                     ?>
                                <div class="row">
                                <div class="col-md-2 col-sm-5">
                                    <label for="name">College #</label>
                                        <?php
                                            echo  form_input( array(
                                                        'name'          => 'college_no',
                                                        'type'          => 'number',
                                                        'value'         => $collegeNo,
                                                        'class'         => 'form-control',
                                                        'placeholder'   => 'College #',
                                                         ));?>
                                </div>
                                
                                <div class="col-md-2 col-sm-5">
                                          <label for="name">Form No.</label>
                                        
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'form_no',
                                                                'type'          => 'text',
                                                                'value'         => $form_no,
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'Form No',
                                                                 )
                                                             );
                                                      ?>
                                              
                                            
                                     </div>
                                <div class="col-md-2 col-sm-5">
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
                                <div class="col-md-2 col-sm-5">
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
                                    
                                 
                            </div>
                             
                              
                           </div><!--//section-content-->
                                     
                                 
                            <div style="padding-top:1%;">
                                <div class="col-md-2 pull-left">
                                    <button type="button" class="btn btn-success" > <i class="fa fa-check"></i>Total Students :<?php echo $count?></button>
                                  </div>
                             
                                <div class="col-md-2 pull-right">
                                    <button type="submit" class="btn btn-theme" name="search" id="search"  value="search" ><i class="fa fa-search"></i> Search</button>
                                  </div>
                            </div>
                                    <?php
                                    echo form_close();
                                    ?>
                    </section>
                    
                    <div class="col-md-12">
                        <h4><?php  
                        if(!empty($pagination_links)):                            
                            echo $pagination_links;
                        endif;
                       ?></h4>
                    </div>
                      
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-boxed table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th width="10">PK</th>
                            <th width="50">Picture</th>
                            <th width="80">Student</th>
                            <th width="100">F-Name</th>
                            <th width="60">College #</th>
                            <th width="110">Sub Program</th>
                            <th width="80">Section</th>
                            <th width="80" >Batch</th>
                            <th width="45"><b>Add Fine</b></th>
                            <th width="45"><b> Show</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
        foreach($result as $rec):
            $education_details = $this->CRUDModel->get_where_row('applicant_edu_detail',array('student_id'=>$rec->student_id));
            echo '<tr class="gradeA">';
                if($education_details):
                    echo '<td><i>'.$rec->student_id.'</i></td>';
                    else:
                    echo '<td><i style="color:red;">'.$rec->student_id.'</td>';
                endif;
                if($rec->applicant_image == ''):
                    echo '<td><img src="assets/images/students/user.png" width="50" height="40"></td>';
                    else:
                    echo '<td><img src="assets/images/students/'.$rec->applicant_image.'" width="50" height="40"></td>';
                endif;
                    echo '<td><a href="admin/student_profile/'.$rec->student_id.'">'.$rec->student_name.'</a></td>';
                    echo '<td>'.$rec->father_name.'</td>';
                    echo '<td>'.$rec->college_no.'</td>';
                    echo '<td>'.$rec->sub_program.'</td>';
                    echo '<td>'.$rec->section.'</td>';
                    echo '<td>'.$rec->batch.'</td>';
                    echo '<td><a class="btn btn-primary btn-sm student_add_fine" id="'.$rec->student_id.'" data-toggle="modal" data-target="#finePopup"><i class="fa fa-plus"></i>  <b>Add Fine</b></a></td>';
                    echo '<td><a class="btn btn btn-theme btn-sm student_show_fine" id="'.$rec->student_id.'" data-toggle="modal" data-target="#fineShowPopup"><i class="fa fa-edit"></i>  <b>Show Fine</b></a></td>';
//                    echo '<td><a class="btn btn-theme btn-sm" href="ViewInterFine/'.$rec->student_id.'" data-toggle="modal" data-target="#fineShowPopup"><i class="fa fa-edit"></i>  <b>Show Fine </b></a></td>';
                    
                echo '</tr>';    
        
            endforeach;
             ?>

                    </tbody>
                </table>  
                    <div class="col-md-12">
                        <h4><?php  
                        
                        if(!empty($pagination_links)):
                            echo $pagination_links;
                        endif;
                       ?></h4>
                    </div>
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
        
        
        
        
    <div class="modal fade" id="finePopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Student Fine</h4>
      </div>
      <div class="modal-body">
          
          <div id="show_student_info">
              
          </div>
         
      </div>
       
    </div>
  </div>
</div>
<div class="modal fade" id="fineShowPopup" tabindex="-1" role="dialog" aria-labelledby="FineSHow">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Student Fine Record</h4>
      </div>
      <div class="modal-body">
          <div id="show_studet_fine">
              
          </div>
      </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-theme" data-dismiss="modal">Close</button>
      
      </div>
       
    </div>
  </div>
</div>
<div class="modal fade" id="fineUpdatePopup" tabindex="-1" role="dialog" aria-labelledby="fineUpdatePopup">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Update Fine Record</h4>
      </div>
      <div class="modal-body">
          <div id="show_update_record">
              
          </div>
      </div>
         
       
    </div>
  </div>
</div>
        
        <script>
        
        jQuery(document).ready(function(){
             
            jQuery('.student_add_fine').on('click',function(){
                var student_id = this.id;
                jQuery.ajax({
                    type    : 'post',
                    url     : 'ShowFineStdRecord',
                    data    : {'student_id':student_id},
                    success : function(result){
                        jQuery('#show_student_info').html(result);
                    }
                    
                });
            });
            
        });
        jQuery(document).ready(function(){
            
            jQuery('.student_show_fine').on('click',function(){
                var student_id = this.id;
                jQuery.ajax({
                    type    : 'post',
                    url     : 'ShowAllFine',
                    data    : {'student_id':student_id},
                    success : function(result){
                        jQuery('#show_studet_fine').html(result);
                    }
                    
                });
            });
            
        });
       
        
        </script>