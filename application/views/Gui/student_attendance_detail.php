        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h3 align="left"><a href="StdAttendance">Teacher Performance</a>  <i class="icon-long-arrow-right"></i> Students Attendance History <small>( Today )</small><hr></h3>
            <div class="row cols-wrapper">
            <div class="col-md-12">    
                <p> 
            <?php
            $pres = count($present);
            $abs = count($absent);
            $tot = count($total);
            if($pres == 0 && $abs == 0 && $tot == 0):
               $per = 0;        
               $aper = 0; 
            else:        
            $per = ($pres/$tot)*100;
            $aper = ($abs/$tot)*100;
            endif; 
        ?>         
        <button type="button" class="btn btn-primary">
            <span style="font-size: 18px;"> Present: <?php  echo round($per,2);?> % </span></button>
        <button type="button" class="btn btn-danger">
            <span style="font-size: 18px;">Absent: <?php echo round($aper,2);?> %</span></button>
        
        </p>
            </div>
        </div>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                     <h4 style="color:red; text-align:center;">
                        <?php print_r($this->session->flashdata('msg'));?>
                    </h4>
                     <p> <button type="button" class="btn btn-success"><i class="fa fa-check-circle"></i>Total Attended Classes Record: <?php echo count($result);?></button> </p>
                    <table id='testing123' cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-boxed table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th>Employee</th>
                            <th>Subject</th>
                            <th>Program</th>
                            <th>Section</th>
                            <th>Present/Leave/Absent</th>
                            <th>Attendance Date</th>
                            <th>View</th>
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
                        ?>
                        <tr class="gradeA">
                            <td><?php echo $rec->emp_name;?></td>
                            <td><?php echo $rec->title;?></td>
                            <td><?php echo $rec->programe_name;?></td>
                            <td><?php echo $rec->name;?></td>
                            <td>
        <span class="badge badge-success">P-<?php echo $present->num_rows();?></span>
        <span class="badge badge-primary">L-<?php echo $leave->num_rows();?></span>
        <span class="badge badge-danger">A-<?php echo $absent->num_rows();?></span>
        <span class="badge badge-warning">Total-<?php echo $total->num_rows();?></span></td>
                            <td><?php echo $rec->attendance_date;?></td>
                            <td><a href="GuiController/student_attendance_view/<?php echo $rec->attend_id;?>/<?php echo $rec->emp_id;?>/<?php echo $rec->subject_id;?>/<?php echo $rec->sec_id;?>" target="_new">View Attendance</a></td>
                           
                        </tr>

                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                    
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
   