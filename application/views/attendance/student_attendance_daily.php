        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Students Attendance History <small>( Today )</small><hr></h2>
            <div class="row cols-wrapper">
            <div class="col-md-12">    
                
                <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line">Search Panel</span>
                        </h1>
                        <div class="section-content" >
                           <?php echo form_open('',array('class'=>'course-finder-form','id'=>'print_wise_form')); ?>
                                <div class="row">
                                    
                                    <div class="col-md-3">
                                        <label for="name">Program</label>
                                        <div class="form-group ">
                                            <?php echo form_dropdown('programe_id', $program,$programe_id,  'class="form-control" id="Programe"'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="name">Sub Program</label>
                                        <div class="form-group ">
                                            <?php echo form_dropdown('sub_pro_id', $sub_program,$sub_pro_id,  'class="form-control" id="SubProgram"'); ?>
                                        </div>
                                    </div> 
                                    
                                <div class="col-md-2">
                                    <label for="name" style="visibility: hidden">Sub Program</label>
                                    <button type="submit" class="btn btn-theme" name="filter" id="filter"  value="filter" ><i class="fa fa-search"></i> Search</button>
                                  </div>
                                </div>
                             
                              
                         
                                    <?php
                                    echo form_close();
                                    ?>   
                            
                           </div><!--//section-content-->
                                     
                    </section>
              
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
                     <p> <button type="button" class="btn btn-success"><i class="fa fa-check-circle"></i>Attended Classes: <?php echo count($result);?></button> </p>
                    <table id='testing123' cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-boxed table-bordered table-striped	 display" style="font-size:12px" width="100%">
                    <thead>
                        <tr>
                            <th>Current Teacher</th>
                            <th>Subject</th>
                            <th>Section</th>
                            <th>Entered By</th>
                            <th>Present/Leave/Absent</th>
                            <th>Attendance Date</th>
                            <th>Entry Date</th>
                            <th>View</th>
                        </tr>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    foreach($result as $rec)  
                    {
                        $attend_id = $rec->attend_id;   
                        $date = $rec->tdate;
                        $date1 = date('d-m-Y H:iA', strtotime($date));     
    $present = $this->db->query("SELECT * FROM student_attendance_details WHERE attend_id = '$attend_id' AND status=1");
    $leave = $this->db->query("SELECT * FROM student_attendance_details WHERE attend_id = '$attend_id' AND status=2");
    $absent = $this->db->query("SELECT * FROM student_attendance_details WHERE attend_id = '$attend_id' AND status=0");
    $total = $this->db->query("SELECT * FROM student_attendance_details WHERE attend_id = '$attend_id'");
        
                                        $this->db->join('users','users.id=student_attendance.user_id');
                                         $this->db->join('hr_emp_record','hr_emp_record.emp_id=users.user_empId');
                           $entery_by =  $this->db->get_where('student_attendance',array('attend_id'=>$rec->attend_id))->row()->emp_name;
                        ?>
                        <tr class="gradeA">
                            <td><?php echo $rec->emp_name;?></td>
                            <td><?php echo $rec->title;?></td>
                            <td><?php echo $rec->name;?></td>
                            <td><?php echo $entery_by?></td>
                            <td>
        <span class="badge badge-success">P-<?php echo $present->num_rows();?></span>
        <span class="badge badge-primary">L-<?php echo $leave->num_rows();?></span>
        <span class="badge badge-danger">A-<?php echo $absent->num_rows();?></span>
        <span class="badge badge-warning">Total-<?php echo $total->num_rows();?></span></td>
                            <td><?php echo date('d-m-Y', strtotime($rec->attendance_date));?></td>
                            <td><?php echo $date1;?></td>
                            <td><a href="AttendanceController/view_attendance/<?php echo $rec->attend_id;?>/<?php echo $rec->emp_id;?>/<?php echo $rec->subject_id;?>/<?php echo $rec->sec_id;?>">Details</a></td>
                           
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
    $(document).ready(function(){
        $('#Programe').on('click',function(){
            var programId = $('#Programe').val(); 
            //get sub program
            $.ajax({
                type   :'post',
                url    :'DDSubPrograms',
                data   :{'programId':programId},
                success :function(result){
                   $('#SubProgram').html(result);
                }
            });
        }); 
    }); 
</script>