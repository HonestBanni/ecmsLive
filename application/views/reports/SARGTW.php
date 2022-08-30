        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            
            <div class="row cols-wrapper">
                
                
                <div class="col-md-12">
                    <div class="table-responsive">
                       <table class="table table-hover table-boxed" id="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Employee Name</th>
                            <th>Section Name</th>
                            <th>Subject Name</th>
                            <th><i class="icon-edit" style="color:#fff"></i><b>View Details</b></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(@$result):
                    $sn ='';
                    foreach($result as $rec):
                        $sn++;
                        ?>
                        <tr class="gradeA">
                            <td><?php echo $sn;?></td>
                            <td><?php echo $rec->employeename;?></td>
                            <td><?php echo $rec->sectionname;?></td>
                            <td><?php echo $rec->subjectname;?></td>
                            <td><a class="btn btn-primary btn-sm" href="SARDR/<?php echo $rec->sectionId?>/<?php echo $rec->subject_id?>/<?php echo $rec->employeeId?>/<?php echo $rec->flag?>">View Details</a></td>
                        </tr>
                        <?php
                            endforeach; 
                            endif;
                         
                        if(@$prac_result):
                        ?>
                         <tr>
                        <td colspan="5" style="color:red;font-size:16px" align="center">
                        <strong>Practical Attendance Report</strong>     
                        </td>
                        </tr>
                        <?php
                    $s ='';
                    foreach($prac_result as $rec):
                        $s++;
                        ?>
                        <tr class="gradeA">
                            <td><?php echo $s;?></td>
                            <td><?php echo $rec->employeename;?></td>
                            <td><?php echo $rec->group_name;?></td>
                            <td><?php echo $rec->subjectname;?></td>
                            <td><a class="btn btn-primary btn-sm" href="SARGP/<?php echo $rec->prac_group_id;?>/<?php echo $rec->prac_subject_id?>/<?php echo $rec->employeeId?>">View Details</a></td>
                           
                        </tr>
                        <?php
                            endforeach; 
                            endif;
                            ?>
                    </tbody>
                </table> 
                         <?php //echo $print_log;?>
                    </div>
                   
                    
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
   