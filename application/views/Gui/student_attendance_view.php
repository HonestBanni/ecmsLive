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
                    <p>
                    <span class="badge badge-success">Present-<?php echo $present; ?></span>
                    <span class="badge badge-primary">Leave-<?php echo $leave; ?></span>
                    <span class="badge badge-danger">Absent-<?php echo $Absent; ?></span></p>
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
                            <td  style="font-size: 15px;"><?php echo $rec->student_name;?></td>
                            <td><?php echo $rec->father_name;?></td>
                            <td><?php echo $rec->college_no;?></td>
                            <td>
                            <?php 
                                if($status == 1)
                                {
                                    echo '<p><span class="label label-success">Present</span></p>';
                                }
                                elseif($status == 2)
                                {
                                    echo '<p><span class="label label-info"> Leave </span></p>';
                                }
                                else
                                {    
                                    echo '<p><span class="label label-danger">Absent</span></p>';
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
    