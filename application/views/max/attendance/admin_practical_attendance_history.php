        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Students Practical Attendance<hr></h2>
            
            <div class="row cols-wrapper">
                <div class="col-md-12">
                     <h4 style="color:red; text-align:center;">
                        <?php print_r($this->session->flashdata('msg'));?>
                    </h4>
                    <form method="post">
                    <div class="form-group col-md-2">
            <?php
                if(!empty($emp_id)){        
                $gres = $this->AttendanceModel->get_by_id('hr_emp_record',array('emp_id'=>$emp_id));
                    foreach($gres as $grec)
                    { ?>          
        <input type="text" name="emp_id" value="<?php echo $grec->emp_name; ?>" placeholder="Employee" class="form-control" id="emp">
                    <input type="hidden" name="emp_id" id="emp_id" value="<?php echo $grec->emp_id; ?>">      
                    <?php 
                    }     
                }else{?>
        <input type="text" name="emp_id" placeholder="Employee" class="form-control" id="emp">
                    <input type="hidden" name="emp_id" id="emp_id">    
                    <?php
                    }    
                ?>                  
            </div>
                    
            <div class="form-group col-md-2">
                <?php
                    if(!empty($group_id)){
                    $gres = $this->AttendanceModel->get_by_id('practical_group',array('prac_group_id'=>$group_id));
                        foreach($gres as $grec)
                        { ?>          
            <input type="text" name="group_id" value="<?php echo $grec->group_name; ?>" placeholder="Group" class="form-control" id="groupName">
                        <input type="hidden" name="group_id" id="group_id" value="<?php echo $grec->prac_group_id; ?>">      
                        <?php 
                        }     
                    }else{?>
                    <input type="text" name="group_id" placeholder="Group" class="form-control" id="groupName">
                            <input type="hidden" name="group_id" id="group_id">    
                        <?php
                        }    
                    ?>                  
            </div>
             <div class="form-group col-md-2">
                <select name="subject_id" class="form-control">
                    <?php
                    if(!empty($subject_id)){
                    $gres = $this->AttendanceModel->get_by_id('practical_subject',array('prac_subject_id'=>$subject_id));
                        foreach($gres as $grec)
                        { ?>          
        <option value="<?php echo $grec->prac_subject_id;?>"><?php echo $grec->title;?></option>
                    <?php } 
                    }?>
                    <option value="">Select Subject</option>
                    <?php 
                    $qry = $this->CRUDModel->getResults('practical_subject');
                    foreach($qry as $subRec):
                    ?>
        <option value="<?php echo $subRec->prac_subject_id;?>"><?php echo $subRec->title;?></option>
                    <?php
                    endforeach;
                    ?>
                </select>           
            </div>
                    <div class="form-group col-md-2">
                            <input type="date" name="attendance_date" value="<?php if($attendance_date): echo $attendance_date;endif; ?>" class="form-control">
                      </div>
                        <div class="form-group col-md-4">
                         <input type="submit" name="search" class="btn btn-theme" value="Search">
                        </div>    
                </form>
                    <p>
            <button type="button" class="btn btn-success">
        <i class="fa fa-check-circle"></i>Total Records: <?php if(@$result): echo count($result); endif;?>
            </button>       
            </p>
                    <table id='testing123' cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-boxed table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th>Employee</th>
                            <th>Subject</th>
                            <th>Group</th>
                            <th>Present / Absent</th>
                            <th>Attendance Date</th>
                            <th>View</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    foreach($result as $rec)  
                    {
                    $attend_id = $rec->attend_id;
                    $date = $rec->attendance_date;
            $newDate = date("d-m-Y", strtotime($date));    
    $present = $this->db->query("SELECT * FROM practical_attendance_details WHERE attend_id = '$attend_id' AND status=1");
    $absent = $this->db->query("SELECT * FROM practical_attendance_details WHERE attend_id = '$attend_id' AND status=0");
    $total = $this->db->query("SELECT * FROM practical_attendance_details WHERE attend_id = '$attend_id'");    
                        ?>
                        <tr class="gradeA">
                            <td><?php echo $rec->emp_name;?></td>
                            <td><?php echo $rec->title;?></td>
                            <td><?php echo $rec->group_name;?></td>
                            <td><span style="color:green"><?php echo $present->num_rows();?></span> / <span style="color:red"><?php echo $absent->num_rows();?></span> (<?php echo $total->num_rows();?>)</td>
                            <td><?php echo $newDate;?></td>
                            <td><a href="AttendanceController/view_practical_attendance/<?php echo $rec->attend_id;?>/<?php echo $rec->emp_id;?>/<?php echo $rec->prac_subject_id;?>/<?php echo $rec->group_id;?>">View Attendance</a></td>
                           
                        </tr>

                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                    
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
   