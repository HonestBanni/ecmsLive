        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Students Practical Attendance<hr></h2>
            
            <div class="row cols-wrapper">
                <div class="col-md-12">
                     <h4 style="color:red; text-align:center;">
                        <?php print_r($this->session->flashdata('msg'));?>
                    </h4>
                    <table id='testing123' cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-boxed table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th>Employee</th>
                            <th>Subject</th>
                            <th>Group</th>
                            <th>Present / Absent</th>
                            <th>Attendance Date</th>
                            <th>Update Practical Attendance</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    foreach($result as $rec)  
                    {
                    $date = $rec->attendance_date;
                    $newDate = date("d-m-Y", strtotime($date));    
                    $attend_id = $rec->attend_id;        
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
                    <td><a href="AttendanceController/change_practical_attendance/<?php echo $rec->attend_id;?>">Update Practical Attendance</a></td>           
                </tr>

                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                    
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
   