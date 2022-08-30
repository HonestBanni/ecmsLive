        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">
                All Classes Alloted List 
                <span  style="float:right">
                    <a href="AttendanceController/merge_class_alloted" class="btn btn-large btn-primary">Merge Classes</a>  
                    <a href="AttendanceController/add_class_alloted" class="btn btn-large btn-primary">Add New Record</a> 
                </span>
                <hr>
            </h2>
            <div class="row cols-wrapper">
                      <div class="col-md-12">    
                       <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line">All Classes Alloted Search</span>
                        </h1>
                        <div class="section-content" >
                           
            <div class="row">
              <?php echo form_open('',array('class'=>'form-inline course-finder-form','name'=>'reportForm'));   ?>
            <div class="col-md-12">
                <div class="form-group">
            <?php        

                if(!empty($emp_id)){
                    $rooms = $this->AttendanceModel->get_by_id('hr_emp_record',array('emp_id'=>$emp_id));
                    foreach($rooms as $roomrec)
                    { ?>          
        <input type="text" name="emp_id" value="<?php echo $roomrec->emp_name; ?>" placeholder="Employee Name" class="form-control" id="emp">
                    <input type="hidden" name="emp_id" id="emp_id" value="<?php echo $roomrec->emp_id; ?>">      
                    <?php 
                    }     
                }else{?>
        <input type="text" name="emp_id" class="form-control" placeholder="Employee Name" id="emp">
            <input type="hidden" name="emp_id" id="emp_id">
                    <?php
                    }    
                ?>                  
            </div>
            <div class="form-group">
            <?php        

                if(!empty($sec_id)){
                    $sect = $this->AttendanceModel->get_by_id('sections',array('sec_id'=>$sec_id));
                    foreach($sect as $sectrec)
                    { ?>          
        <input type="text" name="sec_id" value="<?php echo $sectrec->name; ?>" placeholder="Section Name" class="form-control" id="sec">
                    <input type="hidden" name="sec_id" id="sec_id" value="<?php echo $sectrec->sec_id; ?>">      
                    <?php 
                    }     
                }else{?>
        <input type="text" name="sec_id" class="form-control" placeholder="Section Name" id="sec">
            <input type="hidden" name="sec_id" id="sec_id">        
        
                    <?php
                    }    
                ?>                  
            </div>
            <div class="form-group">
            <?php        

                if(!empty($subject_id)){
                    $subj = $this->AttendanceModel->get_by_id('subject',array('subject_id'=>$subject_id));
                    foreach($subj as $subjrec)
                    { ?>          
        <input type="text" name="subject_id" value="<?php echo $subjrec->title; ?>" placeholder="Subject Name" class="form-control" id="sub">
                    <input type="hidden" name="subject_id" id="subject_id" value="<?php echo $subjrec->subject_id; ?>">      
                    <?php 
                    }     
                }else{?>
        <input type="text" name="subject_id" class="form-control" placeholder="Subject Name" id="sub">
            <input type="hidden" name="subject_id" id="subject_id">        
        
                    <?php
                    }    
                ?>                  
            </div>   
            <div class="form-group">
            <?php echo form_dropdown('mgrp_id', $merge_grp, $m_group_id, 'class="form-control" id="mgrp_id"'); ?>                 
            </div>   
            <div class="form-group">
        <input type="submit" name="submit" value="Search" class="btn btn-theme">
        <input type="submit" name="export" value="Export" class="btn btn-theme">
          </div>
                                    </div>  
                                       <?php
                                    echo form_close();
                                    ?>
                                </div>
                            
                                  
                                
                             
                             
                         </div><!--//section-content-->
                        
                        
                    </section>
          
                    </div>
                <?php
                if(!empty($result)):
                ?>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <p>
            <button type="button" class="btn btn-success">
                <i class="fa fa-check-circle"></i>Total Records: <?php echo count(@$result);?>
            </button>
            </p>
                       <table class="table table-hover table-boxed" id="table">
                    <thead>
                        <tr>
                            <th>S/No</th>
                            <th>Employee Name</th>
                            <th>Section Name</th>
                            <th>Subject Name</th>
                            <th>Sub Program</th>
                            <th>Merged Group</th>
                            <th>View</th>
                            <th><i class="icon-edit" style="color:#fff"></i><b> Update</b></th>
                            <th><i class="icon-trash" style="color:#fff"></i><b> Delete</b></th>
                        </tr>
                    </thead>
                    <tbody>
                <?php
                    $i=1;
                    foreach($result as $rec){
                        ?>
            <tr class="gradeA">
                <td><?php echo $i;?></td>
                <td style="font-size:14px;"><a href="AttendanceController/employee_timetable/<?php echo $rec->emp_id;?>" target="_blank"><?php echo $rec->employee;?></a></td>
                <td><a style="font-size:15px;text-decoration: underline;" href="AttendanceController/section_base_timetable/<?php echo $rec->sec_id;?>" target="_blank"><?php echo $rec->section;?></a></td>
                <td><?php echo $rec->subject;?></td>
                <td><?php echo $rec->name;?></td>
                <td><?php echo $rec->camg_name;?></td>
                <td> <button type="button" id="<?php echo $rec->class_id;?>" class="btn btn-primary btn-sm timetable_details" data-toggle="modal" data-target="#viewTimeTable"> View Details </button></td>
                <td><a class="btn btn-theme btn-sm" href="AttendanceController/update_class_alloted/<?php echo $rec->class_id;?>"> Update</a></td>
                <td><a class="btn btn-danger btn-sm" href="AttendanceController/delete_class_alloted/<?php echo $rec->class_id;?>" 
                       onclick="return confirm('Are You Sure to Delete This..?')">Delete</a></td>
            </tr>

                        <?php
                        $i++;
                        }
                        ?>
                    </tbody>
                </table> 
                    </div> 
                </div><!--//col-md-3-->
                <?php
                endif;
                ?>
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
   <div class="modal fade" id="viewTimeTable" tabindex="-1" role="dialog" aria-labelledby="viewTimeTable">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Time Table Details</h4>
      </div>
      <div class="modal-body">
          <div id="timetable_details_info">
              
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-theme" data-dismiss="modal">Close</button>
      
      </div>
    </div>
  </div>
</div>
        
        <script>
        
        jQuery(document).ready(function(){
           jQuery('.timetable_details').on('click',function(){
     
                var class_id = this.id;
                 jQuery.ajax({
                    type:'post',
                    url : 'TeacherSectionTimeTable',
                    data:{'class_id':class_id},
                    success:function(result){
                       jQuery('#timetable_details_info').html(result);
                    }
                });

            });
            });
        
        </script>