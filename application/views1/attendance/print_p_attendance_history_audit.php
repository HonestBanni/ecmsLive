<script language="javascript">
function printdiv(printpage){
        var headstr = "<html><head><title></title></head><body><p><img class='img-responsive' alt='Edwardes College Peshawar'></p>";
        var footstr = "</body>";
        var newstr = document.all.item(printpage).innerHTML;
        var oldstr = document.body.innerHTML;
        document.body.innerHTML = headstr+newstr+footstr;
        window.print();
        document.body.innerHTML = oldstr;
        return false;
}
</script>

<!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            
            <div class="row cols-wrapper">
                <div class="col-md-12 right">
                        <button type="button" name="print" value="print" onclick="printdiv('div_print');" class="btn btn-theme" style="float: right"><i class="fa fa-print"></i> Print </button>
                        <a href="AttendanceController/search_p_attendance_history_audit" class="btn btn-theme">Back</a>
                    </div>
                
                <div id="div_print">
                    
                    <h2 style="text-align: center;">Teacher Wise Practical Attendance History</h2>
                <div class="col-md-12">
                     
                    <?php if($result):?>
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
                            <!--<th>View</th>-->
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
    
    
                                        $this->db->join('users','users.id=practical_attendance.user_id');
                                         $this->db->join('hr_emp_record','hr_emp_record.emp_id=users.user_empId');
                           $entery_by =  $this->db->get_where('practical_attendance',array('attend_id'=>$rec->attend_id))->row()->emp_name;
                        ?>
                        <tr class="gradeA">
                            <td><?php echo $entery_by?></td>
                            <td><?php echo $rec->title;?></td>
                            <td><?php echo $rec->group_name;?></td>
                            <td><span style="color:green"><?php echo $present->num_rows();?></span> / <span style="color:red"><?php echo $absent->num_rows();?></span> (<?php echo $total->num_rows();?>)</td>
                            <td><?php echo $newDate;?></td>
                            <!--<td><a href="AttendanceController/view_practical_attendance/<?php echo $rec->attend_id;?>/<?php echo $rec->emp_id;?>/<?php echo $rec->prac_subject_id;?>/<?php echo $rec->group_id;?>">View Attendance</a></td>-->
                           
                        </tr>

                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                    <?php endif;?>
                </div><!--//col-md-3-->
                </div>
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->