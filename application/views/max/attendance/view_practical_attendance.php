        <!-- ******CONTENT****** --> 
        <div class="content container">
        	<div class="page-wrapper">
            <header class="page-heading clearfix">
                  <h1 class="heading-title pull-left">View Students Attendance</h1>
                </header>
            </div>
            <div class="row cols-wrapper">
                <div class="col-md-12">
             <h4><strong>Teacher: <?php echo $empRecord->emp_name;?>, Section: <?php echo $section->group_name;?>   
                    </strong>
                    </h4>
                    <strong style="color:green">Present:[<?php echo $present; ?>]</strong>, <strong style="color:red">Absent [<?php echo $Absent;?>] </strong>
             
                    <table id='testing123' cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-boxed table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th>S/No</th>
                            <th>Student Name</th>
                            <th>College No</th>
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
                            <td  style="font-size: 15px;"><?php echo $i;?></td>
                            <td  style="font-size: 15px;"><?php echo $rec->student_name;?></td>
                            <td><?php echo $rec->college_no;?></td>
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
   