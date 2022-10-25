        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">
                <?php if(isset($title) && !empty($title)): echo $title; endif;?> 
                <span  style="float:right">
                    <a href="AttendanceController/merge_class_alloted" class="btn btn-large btn-primary">Merge Classes</a>  
                    <a href="AttendanceController/add_class_alloted" class="btn btn-large btn-primary">Add New Record</a> 
                </span>
                <hr>
            </h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">    
                    <section class="course-finder" style="padding-bottom: 2%; overflow:visible;">
                    <h1 class="section-heading text-highlight">
                        <span class="line"><?php if(isset($title) && !empty($title)): echo $title; endif;?> Search</span>
                    </h1>
                    <div class="section-content" >
                        <?php echo form_open('',array('class'=>'course-finder-form','name'=>'reportForm'));   ?>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="name">Teacher Name</label>
                                     <?php echo form_dropdown('emp_id', $Teachers, '', 'class="form-control dropdown-search" id="TeachersName"'); ?> 
                                    <!--<input type="text" name="emp_id" class="form-control" placeholder="Teacher Name" id="ServingTeachers">-->
                                    <!--<input type="hidden" name="emp_id" id="ServingTeachersID">--> 
                                </div>
                                <div class="col-md-3">
                                    <label for="name">Section Name</label>
                                    <?php echo form_dropdown('sec_id', $Sections, '', 'class="form-control dropdown-search" id="SectionName"'); ?> 
<!--                                    <input type="text" name="sec_id" class="form-control" placeholder="Section Name" id="ActiveSections">
                                    <input type="hidden" name="sec_id" id="ActiveSectionsID"> -->
                                </div>
                              
                                <div class="col-md-3">
                                    <label for="name">Subject Name</label>
                                    <input type="text" name="subject_id" class="form-control" placeholder="Subject Name" id="sub">
                                    <input type="hidden" name="subject_id" id="subject_id"> 
                                </div>
                                  <div class="col-md-3">
                                    <label for="name">Merge Group</label>
                                    <?php echo form_dropdown('mgrp_id', $merge_grp, $m_group_id, 'class="form-control dropdown-search" id="mgrp_id"'); ?> 
                                </div>
                              
                            </div>
                            <div class="row">
                                <div class="col-md-3 pull-right">
                                    <label for="name" style="visibility:hidden;">Merge  sdfasdfs sdfasdf DGroup</label>
                                    <button type="submit" class="btn btn-theme" name="Search" id="Search" value="Search"><i class="fa fa-search"></i> Search</button>
                                    <button type="submit" class="btn btn-theme" name="Export" id="Export" value="Export"><i class="fa fa-save"></i> Export</button>
                                    
<!--                                    <input type="submit" name="submit" value="Search" class="btn btn-theme">
                                    <input type="submit" name="export" value="Export" class="btn btn-theme"> -->
                                </div>
                            </div>
                        <?php echo form_close();   ?>
                    </div>
                    </section>
                </div><!--//section-content-->
                  
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
                            <th>Date Time</th>
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
                <td><?php echo date('d-m-Y H:i:s',strtotime($rec->timestamp));?></td>
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