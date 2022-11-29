        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">All Practicals Alloted List <span  style="float:right"><a href="AttendanceController/add_practical_alloted" class="btn btn-large btn-primary">Add New Record</a></span><hr></h2>
            <div class="row cols-wrapper">
                      <div class="col-md-12">    
                       <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line">All Practicals Alloted Search</span>
                        </h1>
                        <div class="section-content" >
                           
                                <div class="row">
                                      <?php echo form_open('',array('class'=>'form-inline course-finder-form','name'=>'reportForm'));   ?>
                                    <div class="col-md-12">
                                        <div class="form-group">
                       <input type="text" name="emp_id" class="form-control" id="emp" placeholder="Employee Name">
                        <input type="hidden" name="emp_id" id="emp_id">
                    </div>
                     <div class="form-group">
                        <input type="text" name="group_id" class="form-control" id="groupName" placeholder="Group Name">
                        <input type="hidden" name="group_id" id="group_id">
                    </div>
                    <div class="form-group">
                       <select name="subject_id" class="form-control">
                            <option value="">Select Subject</option>
                            <?php
                                $pract = $this->db->query("SELECT * FROM practical_subject order by title asc");
                                foreach($pract->result() as $subs){
                            ?>
                            <option value="<?php echo $subs->prac_subject_id?>"><?php echo $subs->title?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                            <button type="submit" name="search" value="search" id="search" class="btn btn-theme">
                            <i class="fa fa-search"></i> Search </button>
                     </div>
                                    </div>  
                                       <?php
                                    echo form_close();
                                    ?>
                                </div>
                            
                                  
                                
                             
                             
                         </div><!--//section-content-->
                        
                        
                    </section>
          
                    </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <?php if(@$result):?>
                       <table class="table table-hover table-boxed">
                    <thead>
                        <tr>
                            <th>Employee Name</th>
                            <th>Group Name</th>
                            <th>Subject Name</th>
                            <th>View Details</th>
                            <th><i class="icon-edit" style="color:#fff"></i><b> Update</b></th>
                            <th><i class="icon-trash" style="color:#fff"></i><b> Delete</b></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    foreach($result as $rec)  
                    {
                        ?>
                <tr class="gradeA">
                    <td><a href="AttendanceController/employee_prac_timetable/<?php echo $rec->emp_id;?>" target="_blank"><?php echo $rec->emp_name;?></a></td>
                    <td><a style="font-size:15px;text-decoration: underline;" href="AttendanceController/section_base_Prac_timetable/<?php echo $rec->group_id;?>" target="_blank"><?php echo $rec->group_name;?></a></td>
                    <td><?php echo $rec->title;?></td>
                    <td><a href="javascript:valid(0)" id="<?php echo $rec->practical_class_id;?>" class="prac_timetable_details"><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal"> View Details </button></a></td>
                    <td><a class="btn btn-theme btn-sm" href="AttendanceController/update_practical_alloted/<?php echo $rec->practical_class_id;?>"> Update</a></td>
                    <td><a href="AttendanceController/delete_practical_alloted/<?php echo $rec->practical_class_id;?>" class="btn btn-danger btn-sm" 
                           onclick="return confirm('Are You Sure to Delete This..?')">Delete</a></td>
                        </tr>

                        <?php
                        }
                        ?>
                    </tbody>
                </table> 
                        <?php endif;?>
                    </div>
                   
                    
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Practical Time Table Details</h4>
      </div>
      <div class="modal-body">
          <div id="prac_timetable_info">
              
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-theme" data-dismiss="modal">Close</button>
      
      </div>
    </div>
  </div>
</div>