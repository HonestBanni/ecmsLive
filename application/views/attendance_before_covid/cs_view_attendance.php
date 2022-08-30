        <!-- ******CONTENT****** --> 
        <div class="content container">
            <div class="page-wrapper">
            <header class="page-heading clearfix">
                  <h1 class="heading-title pull-left">View Students Attendance</h1>
                </header>
            </div>
            <div class="row cols-wrapper">
                <div class="col-md-12">  
                    <h4><strong>Teacher: <?php echo $empRecord->emp_name;?>, Section: <?php echo $section->name;?>   
                    </strong>
                    </h4>
                    <strong style="color:green">Present:[<?php echo $present; ?>]</strong>, 
                    <strong style="color:red">Absent [<?php echo $Absent;?>]</strong>,
            <?php $attend_id = $this->uri->segment(3);
            $total = $this->db->query("SELECT * FROM student_attendance_details WHERE attend_id = '$attend_id'");?>
            <strong>Total [<?php  echo $total->num_rows(); ?>]</strong>
                    <table id='testing123' cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-boxed table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th>Serial No</th>
                            <th>Student Picture</th>
                            <th>College No</th>
                            <th>Student Name</th>
                            <th>Father Name</th>
                            <th>status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                    foreach($result as $rec)  
                    {
                        $status = $rec->status;
                        ?>
                        <tr class="gradeA">
                            <td><?php echo $i;?></td>
            <td><img src="assets/images/students/<?php echo $rec->applicant_image;?>" width="60" height="50"></td>
                            <td><?php echo $rec->college_no;?></td>
                            <td style="font-size: 15px;"><?php echo $rec->student_name;?></td>
                            <td><?php echo $rec->father_name;?></td>
                            <td>
                            <?php 
                                if($status == 1)
                                {
                                    echo '<span style="color:green">Present</span>';
                                }
                                else
                                {    
                                    echo '<span style="color:red">Absent</span>';   
                                }
                        ?>
                        </td> 
                                
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
   