<div class="content container">
    <h2 align="left">Teacher Subjects List<hr></h2>
        <div class="row cols-wrapper">
            <div class="col-md-12">
                <form method="post" action="AttendanceController/search_attendance_history">
                    <div class="form-group col-md-2">
            <?php
                $gres = $this->AttendanceModel->get_by_id('hr_emp_record',array('emp_id'=>$emp_id));
                if($gres){
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
                    $gres = $this->AttendanceModel->get_by_id('sections',array('sec_id'=>$sec_id));
                    if($gres){
                        foreach($gres as $grec)
                        { ?>          
            <input type="text" name="sec_id" value="<?php echo $grec->name; ?>" placeholder="Section" class="form-control" id="sec">
                        <input type="hidden" name="sec_id" id="sec_id" value="<?php echo $grec->sec_id; ?>">      
                        <?php 
                        }     
                    }else{?>
                    <input type="text" name="sec_id" placeholder="Section" class="form-control" id="sec">
                            <input type="hidden" name="sec_id" id="sec_id">    
                        <?php
                        }    
                    ?>                  
            </div>
                    
            <div class="form-group col-md-2">
                <?php
                    $gres = $this->AttendanceModel->get_by_id('subject',array('subject_id'=>$subject_id));
                    if($gres){
                        foreach($gres as $grec)
                        { ?>          
                        <input type="text" name="subject_id" value="<?php echo $grec->title; ?>" placeholder="Subject" class="form-control" id="sub">    
                        <?php 
                        }     
                    }else{?>
                        <input type="text" name="subject_id" placeholder="Subject" class="form-control" id="sub">
                        <input type="hidden" name="subject_id" id="subject_id">   
                        <?php
                        }    
                    ?>                  
            </div>
                    
            <div class="form-group col-md-2">
                <?php
                $gres = $this->AttendanceModel->getDBUserWhere('users',array('id'=>$dbuser_id));
                if($gres){?>          
                    <input type="text" name="dbuser_id" value="<?php echo $gres->emp_name; ?>" placeholder="Employee" class="form-control" id="empdbuser">
                    <input type="hidden" name="dbuser_id" id="dbUserId" value="<?php echo $gres->dbuser_id; ?>">      
                    <?php      
                }else{?>
                    <input type="text" name="dbuser_id" placeholder="Entered by" class="form-control" id="empdbuser">
                    <input type="hidden" name="dbuser_id" id="dbUserId">  
                    <?php
                    }    
                ?>                  
            </div>
                    
                    <div class="form-group col-md-2">
                            <input type="date" name="attendance_date" value="<?php if($attendance_date): echo $attendance_date;endif; ?>" class="form-control">
                      </div>
                         <input type="submit" name="search" class="btn btn-theme" value="Search">
                         <input type="submit" name="print" class="btn btn-theme" value="Print">
                </form>
            </div>
        </div>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                     <h4 style="color:red; text-align:center;">
                        <?php print_r($this->session->flashdata('msg'));?>
                    </h4>
                     <p><button type="button" class="btn btn-success"><i class="fa fa-check-circle"></i>Total Records: <?php echo count($result);?></button></p>
                    <table id='testing123' cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-boxed table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th>Current Teacher</th>
                            <th>Subject</th>
                            <th>Section</th>
                            <th>Entered By</th>
                            <th>Present/Leave/Absent</th>
                            <th>Attendance Date</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    foreach($result as $rec)  
                    {
                        $attend_id = $rec->attend_id;        
    $present = $this->db->query("SELECT * FROM student_attendance_details WHERE attend_id = '$attend_id' AND status=1");
    $leave = $this->db->query("SELECT * FROM student_attendance_details WHERE attend_id = '$attend_id' AND status=2");
    $absent = $this->db->query("SELECT * FROM student_attendance_details WHERE attend_id = '$attend_id' AND status=0");
    $total = $this->db->query("SELECT * FROM student_attendance_details WHERE attend_id = '$attend_id'"); 
    
    
                                        $this->db->join('users','users.id=student_attendance.user_id');
                                         $this->db->join('hr_emp_record','hr_emp_record.emp_id=users.user_empId');
                           $entery_by =  $this->db->get_where('student_attendance',array('attend_id'=>$rec->attend_id))->row()->emp_name;
                        ?>
                        <tr class="gradeA">
                            <td><?php echo $rec->employee;?></td>
                            <td><?php echo $rec->subject;?></td>
                            <td><?php echo $rec->section;?></td>
                            <td><?php echo $entery_by;?></td>
                            <td>
        <span class="badge badge-success">P-<?php echo $present->num_rows();?></span>
        <span class="badge badge-primary">L-<?php echo $leave->num_rows();?></span>
        <span class="badge badge-danger">A-<?php echo $absent->num_rows();?></span>
        <span class="badge badge-warning">Total-<?php echo $total->num_rows();?></span></td>
                            <td><?php echo $rec->attendance_date;?></td>
                            <td><a href="AttendanceController/admin_view_attendance/<?php echo $rec->attend_id;?>/<?php echo $rec->emp_id;?>/<?php echo $rec->subject_id;?>/<?php echo $rec->sec_id;?>">View Attendance</a></td>
                           <td><a href="AttendanceController/admin_delete_attendance/<?php echo $rec->attend_id;?>" onclick="return confirm('Are you really want to Delete?')">Delete</a></td>
                        </tr>

                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                    
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->  
        </div><!--//content-->
   
<script>
    jQuery(document).ready(function(){
        jQuery("#empdbuser").autocomplete({  
            minLength: 0,
            source: "AttendanceController/auto_dbuser/"+$("#empdbuser").val(),
            autoFocus: true,
            scroll: true,
            dataType: 'jsonp',
            select: function(event, ui){
            jQuery("#empdbuser").val(ui.item.contactPerson);
            jQuery("#dbUserId").val(ui.item.db_id);
            }
            }).focus(function() {  jQuery(this).autocomplete("search", "");  
        });
    });
</script>