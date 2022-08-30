        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Students Attendance Change Status (Degree Level)<hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
        <form method="post">
            <div class="form-group col-md-3">
                    <input type="text" name="college_no" placeholder="College No." value="<?php if($college_no): echo $college_no;endif; ?>" class="form-control">
              </div>
              <div class="form-group col-md-3">
                    <input type="text" name="student_id" placeholder="Student Name" class="form-control" id="std_names">
                    <input type="hidden" name="student_id" id="student_id">
               </div>
                    <input type="submit" name="submit" class="btn btn-theme" value="Search">
         </form>
                    </div>
            <?php if(@$result): ?> 
               <div class="col-md-12">
                   <p><strong style="font-size:16px;">Change Attendance Status:</strong></p>
        <form method="post" action="AttendanceController/change_attendance_status_degree">
            <div class="form-group col-md-3">
                    <input type="hidden" name="student_id" value="<?php echo $result->student_id;?>">
                    <input type="text" name="attendance_date" value="<?php echo date('d-m-Y');?>" class="form-control date_format_d_m_yy" required>
              </div>
              <div class="form-group col-md-3">
                  <select class="form-control" name="status">
                    <option value="2">Leave</option>
                    <option value="1">Present</option>
                    <option value="0">Absent</option>
                  </select>
               </div>
            <input type="submit" name="submit" class="btn btn-theme" value="Change Status">
         </form>
                    </div> 
            <p>
            <button type="button" class="btn btn-success">
                <i class="fa fa-check-circle"></i>Total Records: <?php echo count(@$result);?>
            </button>
            </p>
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-boxed table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th>Picture</th>
                            <th>Student</th>
                            <th>F-Name</th>
                            <th>College #</th>
                            <th>Sub Program</th>
                            <th>Batch</th>
                            <th>Section</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
$i = 1;
    
    $student_id = $result->student_id;
    $student_name = $result->student_name;
    $father_name = $result->father_name;
    $applicant_image = $result->applicant_image;           
    $section = $result->section;                          
                        ?>
                        <tr class="gradeA">
                            <td><?php
                    if($applicant_image == "")
                    {?>
        <img src="<?php echo base_url();?>assets/images/students/user.png" width="60" height="60">
                    <?php
                    }else
                    {?>
    <img src="<?php echo base_url();?>assets/images/students/<?php echo $applicant_image;?>" style="border-radius:10px;" width="60" height="60">
                <?php 
                    }
                    ?></td>
 <td><a href="<?php echo base_url();?>admin/student_profile/<?php echo $student_id;?>">
     <span style="font-size:15px;"><?php echo $student_name;?></span></a>    
                    </td>
                    <td><?php echo $father_name;?></td>
                    <td><?php echo $result->college_no;?></td>
                    <td><?php echo $result->sub_program;?></td>
                    <td><?php echo $result->batch;?></td>
                    <td><?php echo $section;?></td>   
    </tr>

                    </tbody>
                </table>
<?php else: echo '<h3 style="color:red">Record Not Found..</h3>'; endif;?>               
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           