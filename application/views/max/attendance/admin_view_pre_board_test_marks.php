        <!-- ******CONTENT****** --> 
        <div class="content container">
            <div class="page-wrapper">
            <header class="page-heading clearfix">
                  <h1 class="heading-title pull-left">View Test Marks List</h1>
                </header>
            </div>
            <div class="row cols-wrapper">
                <div class="col-md-12">  
                    <h4><strong>Teacher: <?php echo $empRecord->emp_name;?>, Section: <?php echo $section->name;?>   
                    </strong>
                    </h4>
            <?php $test_id = $this->uri->segment(3);
            $total = $this->db->query("SELECT * FROM pre_board_test_details WHERE test_id = '$test_id'");?>
            <strong>Total [<?php  echo $total->num_rows(); ?>]</strong>
                    <table class="datatable-1 table table-boxed table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Serial No</th>
                            <th>Student Picture</th>
                            <th>College No</th>
                            <th>Student Name</th>
                            <th>Father Name</th>
                            <th>Obt-Marks/T-Marks</th>
                            <th>Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                    foreach($result as $rec)  
                    {
                        ?>
                        <tr class="gradeA">
            <td><?php echo $i;?></td>
            <td><img src="assets/images/students/<?php echo $rec->applicant_image;?>" width="60" height="50"></td>
                <td><?php echo $rec->college_no;?></td>
                <td style="font-size: 15px;"><?php echo $rec->student_name;?></td>
                <td><?php echo $rec->father_name;?></td>
                <td style="font-size: 15px;"><?php echo $rec->omarks;?> /<?php echo $rec->tmarks;?></td> 
                <td><a href="AttendanceController/admin_update_pre_board_marks/<?php echo $rec->serial_no;?>">Update Pre Board Marks</a></td> 
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
   