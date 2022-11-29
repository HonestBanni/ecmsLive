        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">HOD Monthly Tests History<hr></h2>
            <div class="row cols-wrapper">
            <div class="col-md-12">    
                <form method="post">
                  <div class="form-group col-md-2">
                        <input type="text" name="emp_id" placeholder="Employee" class="form-control" id="emp">
                            <input type="hidden" name="emp_id" id="emp_id">
                  </div>
                  <input type="submit" name="search" class="btn btn-theme" value="Search">
                </form>
            </div>
        </div>
            <?php 
            if(@$result):
            ?>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                     <p>
                         <button type="button" class="btn btn-success"><i class="fa fa-check-circle"></i>Total Records: <?php echo count($result);?></button>
                    </p>
                    <table class="table table-boxed table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Employee</th>
                            <th>Subject</th>
                            <th>Section</th>
                            <th>Date</th>
                            <th>Print</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    foreach($result as $rec)  
                    {
                         $date = $rec->test_date;
            $newDate = date("d-m-Y", strtotime($date)); 
                        ?>
                        <tr class="gradeA">
                            <td><?php echo $rec->employee;?></td>
                            <td><?php echo $rec->subject;?></td>
                            <td><?php echo $rec->section;?></td>
                            <td><?php echo $newDate;?></td>
                           <td><a class="btn btn-primary btn-sm" href="AttendanceController/admin_print_test_marks_list/<?php echo $rec->test_id;?>/<?php echo $rec->emp_id;?>/<?php echo $rec->subject_id;?>/<?php echo $rec->sec_id;?>">Print</a></td>
                        </tr>

                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                    <?php
                    endif;
                    ?>
                </div><!--//col-md-3-->
            </div><!--//cols-wrapper-->
        </div><!--//content-->
   