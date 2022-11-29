        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Computer Science Department Attendance History<hr></h2>
<!--
            <div class="row cols-wrapper">
            <div class="col-md-12">    
                <form method="post" action="AttendanceController/search_attendance_history">
                      <div class="form-group col-md-2">
                            <input type="text" name="emp_id" placeholder="Employee" class="form-control" id="emp">
                                <input type="hidden" name="emp_id" id="emp_id">
                      </div>
                      <div class="form-group col-md-2">
                            <input type="text" name="sec_id" placeholder="Section" class="form-control" id="sec">
                            <input type="hidden" name="sec_id" id="sec_id">
                      </div>
                      <div class="form-group col-md-2">
                            <input type="text" name="subject_id" placeholder="Subject" class="form-control" id="sub">
                            <input type="hidden" name="subject_id" id="subject_id">
                      </div>
                    <div class="form-group col-md-2">
                            <input type="date" name="attendance_date" class="form-control">
                      </div>
                         <input type="submit" name="search" class="btn btn-theme" value="Search">
                </form>
            </div>
        </div>
-->
            <div class="row cols-wrapper">
                <div class="col-md-12">
                     <h4 style="color:red; text-align:center;">
                        <?php print_r($this->session->flashdata('msg'));?>
                    </h4>
                    <h3>Total Records: <?php echo count($result);?></h3>
                    <table id='testing123' cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-boxed table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th>Serial No</th>
                            <th>Employee</th>
                            <th>Subject</th>
                            <th>Section</th>
                            <th>Present/Absent</th>
                            <th>Attendance Date</th>
                            <th>View</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                    foreach($result as $rec)  
                    {
                        $attend_id = $rec->attend_id;        
    $present = $this->db->query("SELECT * FROM student_attendance_details WHERE attend_id = '$attend_id' AND status=1");
    $absent = $this->db->query("SELECT * FROM student_attendance_details WHERE attend_id = '$attend_id' AND status=0");
    $total = $this->db->query("SELECT * FROM student_attendance_details WHERE attend_id = '$attend_id'");
                        ?>
                        <tr class="gradeA">
                            <td><?php echo $i;?></td>
                            <td><?php echo $rec->emp_name;?></td>
                            <td><?php echo $rec->title;?></td>
                            <td><?php echo $rec->name;?></td>
                            <td><span style="color:green"><?php echo $present->num_rows();?></span> / <span style="color:red"><?php echo $absent->num_rows();?></span> (<?php echo $total->num_rows();?>)</td>
                            <td><?php echo $rec->attendance_date;?></td>
                            <td><a href="AttendanceController/cs_view_attendance/<?php echo $rec->attend_id;?>/<?php echo $rec->emp_id;?>/<?php echo $rec->subject_id;?>/<?php echo $rec->sec_id;?>">View Attendance</a></td>
                           
                        </tr>

                        <?php
                        $i++;
                        }
                        ?>
                    </tbody>
                </table>
                    
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
   