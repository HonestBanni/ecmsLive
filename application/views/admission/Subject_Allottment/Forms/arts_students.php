        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left"><?php echo $page_header?><hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line"><?php echo $page_header?> Panel</span>
                        </h1>
                        <div class="section-content" >
                           <?php echo form_open('',array('class'=>'course-finder-form','id'=>'print_wise_form'));
                                  
                                     ?>
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
                                                                'placeholder'   => 'Form #',
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
                                                                'name'          => 'college_no',
                                                                'type'          => 'number',
                                                                'value'         => $collegeNo,
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
                                                                'name'          => 'student_name',
                                                                'type'          => 'text',
                                                                'value'         => $stdName,
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'Student Name',
                                                                 )
                                                             );
                                                      ?>
                                              </div>
                                            
                                     </div>
                                <div class="col-md-2 col-sm-5">
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
                                    <label for="name">Program</label>
                                    <div class="form-group ">
                                        <?php 
                                            echo form_dropdown('programe_id', $program,$programe_id,  'class="form-control"');
                                        ?>
                                    </div>
                                </div>
                         
                                <div class="col-md-2">
                                    <label for="name">Sub Program</label>
                                    <div class="form-group ">
                                        <?php 
//                                        $sub_program = array('Sub Program'=>"Sub Program");
                                                echo form_dropdown('sub_pro_id', $sub_program,$sub_pro_id,  'class="form-control"');
                                        ?>
                                    </div>
                                </div> 
                                <div class="col-md-2">
                                    <label for="name">Sub Program</label>
                                    <div class="form-group ">
                                        <?php 
//                                        $sub_program = array('Sub Program'=>"Sub Program");
                                                echo form_dropdown('batch', $batch,$batch_id,  'class="form-control" id="batch_id"');
                                        ?>
                                    </div>
                                </div> 
                            </div>
                             
                              
                           </div><!--//section-content-->
                                     
                                 
                            <div style="padding-top:1%;">
                                <div class="col-md-2 pull-left">
                                    <button type="button" class="btn btn-success" >Total Students :<?php echo $count?></button>
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
                            
                        echo    $pagination_links;
                            
                        endif;
                       ?></h4>
                    </div>
                      
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-boxed table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th width="10">SN</th>
                            <th width="10">PK</th>
                            <th width="50">Picture</th>
                            <th width="80">Student</th>
                            <th width="100">F-Name</th>
                            <th width="60">College #</th>
                            <th width="110">Sub Program</th>
                            <th width="80" >Batch</th>
                            <th width="80">Section</th>
                            <th width="45"><i class="icon-edit" style="color:#fff"></i><b> Assigned Subjects</b></th>
                             <?php
                            
                           
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
              $sn = '';          
                foreach($result as $rec):
                    $sn++;
            //                  echo '<pre>';print_r($rec);die;
                        $education_details  = $this->CRUDModel->get_where_row('applicant_edu_detail',array('student_id'=>$rec->student_id));
                        $subject_checks     = $this->CRUDModel->get_where_row('student_subject_alloted',array('student_id'=>$rec->student_id));

                            echo '<tr class="gradeA">';
                            if($education_details):
                                echo '<td><i>'.$sn.'</i></td>';
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
                                echo '<td>'.$rec->batch.'</td>';
                                echo '<td>'.$rec->section.'</td><td>';


                                    if($subject_checks):
                                        echo '<a class="btn btn-success btn-sm" href="admin/student_updassign_subjects/'.$rec->student_id.'/'.$rec->sub_pro_id.'">Update Subjects</a>';
                                        else:
                                        echo '<a class="btn btn-primery btn-sm" href="admin/student_assign_subjects/'.$rec->student_id.'/'.$rec->sub_pro_id.'">Assign Subjects</a>';
                                    endif;

                            echo '</td></tr>';    

                        endforeach;
             ?>

                    </tbody>
                </table>   
                    <div class="col-md-12">
                        <h4><?php  
                        
                        if(!empty($pagination_links)):
                            
                        echo    $pagination_links;
                            
                        endif;
                       ?></h4>
                    </div>
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->