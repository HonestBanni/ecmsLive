<script language="javascript">
function printdiv(printpage){
        var headstr = "<html><head><title></title></head><body><p><img  class='img-responsive' alt='Edwardes College Peshawar'></p>";
        var footstr = "</body>";
        var newstr = document.all.item(printpage).innerHTML;
        var oldstr = document.body.innerHTML;
        document.body.innerHTML = headstr+newstr+footstr;
        window.print();
        document.body.innerHTML = oldstr;
        return false;
}
</script>

<div class="content container">
    
            <div class="row cols-wrapper">
                    <div class="col-md-12 right">
                        <button type="button" name="print" value="print" onclick="printdiv('div_print');" class="btn btn-theme" style="float: right"><i class="fa fa-print"></i> Print </button>
                        <a href="AttendanceController/search_attendance_history_bs" class="btn btn-theme">Back</a>
                    </div>
                <div id="div_print">
                    <h2 style="text-align: center;">Teacher Wise Attendance History</h2>
                    <div class="col-md-12">
                    <p><button type="button" class="btn btn-success"><i class="fa fa-check-circle"></i>Total Records: <?php echo count($result);?></button></p>
                    
                    <table id='testing123' cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-boxed table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th>Teacher</th>
                            <th>Subject</th>
                            <th>Section</th>
                            <th>Duration</th>
                            <th>Present/Leave/Absent</th>
                            <th>Attendance Date</th>
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
                           
                           $this->db->join('class_starting_time','class_starting_time.stime_id=timetable.stime_id');
                                        $this->db->join('class_ending_time','class_ending_time.etime_id=timetable.etime_id');
                        $time_table =   $this->db->get_where('timetable',array('class_id'=>$rec->class_id))->row();
                        ?>
                        <tr class="gradeA">
                            <td><?php echo $entery_by;?></td>
                            <td><?php echo $rec->subject;?></td>
                            <td><?php echo $rec->section;?></td>
                            <td><?php echo $time_table->class_stime.','.$time_table->class_etime;?></td>
                            <td>
                                <span class="badge badge-success">P-<?php echo $present->num_rows();?></span>
                                <span class="badge badge-primary">L-<?php echo $leave->num_rows();?></span>
                                <span class="badge badge-danger">A-<?php echo $absent->num_rows();?></span>
                                <span class="badge badge-warning">Total-<?php echo $total->num_rows();?></span></td>
                            <td><?php echo date('D d M, Y',strtotime($rec->attendance_date));?></td>
                        </tr>

                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                    </div>
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