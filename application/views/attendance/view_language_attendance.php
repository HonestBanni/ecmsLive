        <!-- ******CONTENT****** --> 
        <div class="content container">
        	<div class="page-wrapper">
            <header class="page-heading clearfix">
                  <h1 class="heading-title pull-left">View Students Attendance (Language)</h1>
                </header>
            </div>
            <div class="row cols-wrapper">
                <div class="col-md-12">
             <h4><strong>Language: <?php echo $program->programe_name;?>, Batch: <?php echo $batch->batch_name;?>   
                    </strong>
                    </h4>
                    <p>
                    <span class="badge badge-success">Present-<?php echo $present; ?></span>
                    <span class="badge badge-primary">Leave-<?php echo $leave; ?></span>
                    <span class="badge badge-danger">Absent-<?php echo $Absent; ?></span>
                    <span class="badge badge-theme">Total Students: <?php echo count($count); ?></span></p>
                    <table class="table table-boxed table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>S #</th>
                            <th>Student Name</th>
                            <th>Form No</th>
                            <th>status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $s = 1;
                    foreach($result as $rec)  
                    {
                        $status = $rec->status;
                        ?>
                        <tr class="gradeA">
                            <td><?php echo $s;?></td>
                            <td  style="font-size: 15px;"><?php echo $rec->student_name;?></td>
                            <td><?php echo $rec->form_no;?></td>
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
                        $s++;
                        }
                        ?>
                    </tbody>
                </table>
                    
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
   