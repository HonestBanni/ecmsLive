        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">View Students Attendance<hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                  
                    <table id='testing123' cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-boxed table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th>Student Picture</th>
                            <th>Student Name</th>
                            <th>Father Name</th>
                            <th>College No</th>
                            <th>status</th>
                        </tr>
                    </thead>
                    <tbody>
            
                        <?php
                    foreach($result as $rec)  
                    {
                        $status = $rec->status;
                        ?>
                        <tr class="gradeA">
                            <td><img src="assets/images/students/<?php echo $rec->applicant_image;?>" width="60" height="50"></td>
                            <td><?php echo $rec->student_name;?></td>
                            <td><?php echo $rec->father_name;?></td>
                            <td><?php echo $rec->college_no;?></td>
                            <td>
                            <?php 
                                if($status == 1)
                                {
                                    echo 'Present';
                                }
                                else
                                {    
                                    echo 'Absent';   
                                }
                        ?>
                        </td>          
                        </tr>

                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                    
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
   